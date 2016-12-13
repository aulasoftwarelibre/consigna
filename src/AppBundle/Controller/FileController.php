<?php
/**
 * This file is part of the Consigna project.
 *
 * (c) Juan Antonio Martínez <juanto1990@gmail.com>
 * (c) Sergio Gómez <sergio@uco.es>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


namespace AppBundle\Controller;


use AppBundle\Doctrine\Annotation\Filter;
use AppBundle\Entity\File;
use AppBundle\Entity\Interfaces\FileInterface;
use AppBundle\Form\Type\FileCreateType;
use AppBundle\Form\Type\FileDownloadType;
use AppBundle\Security\Voter\FileVoter;
use AppBundle\Security\Voter\FolderVoter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class FileController
 * @package AppBundle\Controller
 *
 * @Filter({
 *     "consigna_enabled_entity",
 *     "consigna_expired_entity",
 *     "consigna_scan_clean_file",
 * })
 * @Route("/file")
 */
class FileController extends Controller
{
    /**
     * Delete a file.
     *
     * @param File $file
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @Method("DELETE")
     * @ParamConverter(
     *     "file",
     *     options={
     *          "repository_method" = "findOneActiveBy",
     *     }
     * )
     * @Route(
     *     "/{slug}/delete",
     *     name="file_delete"
     * )
     * @Security("is_granted('DELETE', file)")
     */
    public function deleteAction(File $file, Request $request)
    {
        $form = $this
            ->createFormBuilder()
            ->setMethod('DELETE')
            ->getForm()
            ->handleRequest($request);

        if ($form->isValid()) {
            $this
                ->get('consigna.manager.file')
                ->deleteFile($file);
            $this->addFlash('success', 'alert.file_delete_ok');
        } else {
            $this->addFlash('success', 'alert.file_delete_error');
        }

        if ($file->getFolder()) {
            return $this->redirectToRoute('folder_show', [
                'slug' => $file->getFolder()->getSlug(),
            ]);
        }

        return $this->redirectToRoute('homepage');
    }

    /**
     * @param File $file
     * @param Request $request
     *
     * @return Response
     *
     * @Method("GET")
     * @ParamConverter(
     *     "file",
     *     options={
     *          "repository_method" = "findOneActiveBy",
     *     }
     * )
     * @Route(
     *     "/{slug}/download",
     *     name="file_download"
     * )
     */
    public function downloadAction(File $file, Request $request)
    {
        $folder = $file->getFolder();

        if ($folder) {
            if (false === $this->isGranted(FolderVoter::DOWNLOAD, $folder)) {
                return $this->redirectToRoute('folder_show', [
                    'slug' => $folder->getSlug(),
                ]);
            }
        } else {
            if (false === $this->isGranted(FileVoter::DOWNLOAD, $file)) {
                return $this->redirectToRoute('file_show', [
                    'slug' => $file->getSlug(),
                ]);
            }
        }

        $response = new BinaryFileResponse($file->getPath());
        $response->trustXSendfileTypeHeader();
        $response->prepare($request);
        $response->setContentDisposition(
            ResponseHeaderBag::DISPOSITION_ATTACHMENT,
            $file->getName(),
            iconv('UTF-8', 'ASCII//TRANSLIT', $file->getName())
        );

        $this
            ->get('consigna.event_dispatcher.file')
            ->dispatchFileOnDownloadedEvent($file);

        return $response;
    }

    /**
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Method({"GET", "POST"})
     * @Route(
     *     "/upload",
     *     name="file_upload"
     * )
     */
    public function uploadAction(Request $request)
    {
        $file = $this
            ->get('consigna.factory.file')
            ->createNew();

        $form = $this
            ->createForm(FileCreateType::class, $file, [
                'user' => $this->getUser(),
            ])
            ->handleRequest($request);

        if ($form->isValid()) {
            $file = $this
                ->get('consigna.manager.file')
                ->createFile($file);

            switch ($file->getScanStatus()) {
                case FileInterface::SCAN_STATUS_OK:
                    $this->addFlash('success', 'upload.success');
                    break;
                case FileInterface::SCAN_STATUS_INFECTED:
                    $this->addFlash('danger', 'upload.virus');
                    break;
                default:
                    $this->addFlash('danger', 'upload.failed');
            }

            return $this->redirectToRoute('homepage');
        }

        return $this->render('frontend/File/upload.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @param File $file
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Method("GET")
     * @ParamConverter(
     *     "file",
     *     options={
     *          "repository_method" = "findOneActiveBy",
     *     }
     * )
     * @Route(
     *     "/{slug}/show",
     *     name="file_show"
     * )
     */
    public function showAction(File $file)
    {
        if (false === $this->isGranted(FileVoter::ACCESS, $file)) {
            $this->addFlash('warning', 'alert.login_required');

            return $this->render('frontend/File/show_with_login.html.twig', [
                'file' => $file,
            ]);
        }

        if (false === $this->isGranted(FileVoter::DOWNLOAD, $file)) {
            $form = $this->createForm(FileDownloadType::class, $file, [
                'user' => $this->getUser(),
            ]);

            return $this->render('frontend/File/show_with_password.html.twig', [
                'file' => $file,
                'form' => $form->createView(),
            ]);
        }

        return $this->render('frontend/File/show.html.twig', [
            'file' => $file,
        ]);
    }

    /**
     * @param File $file
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Method("POST")
     * @ParamConverter(
     *     "file",
     *     options={
     *          "repository_method" = "findOneActiveBy",
     *     }
     * )
     * TODO: change name
     * @Route(
     *     "/{slug}/show",
     *     name="file_check"
     * )
     */
    public function showCheckPasswordAction(File $file, Request $request)
    {
        $user = $this->getUser();

        if (false === $this->isGranted(FileVoter::DOWNLOAD, $file)) {
            $form = $this
                ->createForm(FileDownloadType::class, $file, [
                    'user' => $this->getUser(),
                ])
                ->handleRequest($request)
            ;

            if ($form->isValid()) {
                $this
                    ->get('consigna.manager.file')
                    ->sharedFileWithUser($file, $user);
            } else {
                return $this->render('frontend/File/show_with_password.html.twig', [
                    'file' => $file,
                    'form' => $form->createView(),
                ]);
            }
        }

        return $this->redirectToRoute('file_show', [
            'slug' => $file->getSlug(),
        ]);
    }
}