<?php

namespace AppBundle\Controller\Frontend;

use AppBundle\Doctrine\Extensions\UploadedFileInfo;
use AppBundle\Entity\File;
use AppBundle\Entity\User;
use AppBundle\Form\Type\DownloadFileAnonType;
use AppBundle\Form\Type\DownloadFileType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\Type\CreateFileType;
use AppBundle\Form\Type\CreateFileAnonType;
use AppBundle\Event\FileEvent;
use AppBundle\Event\FileEvents;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Class FileController
 * @package AppBundle\Controller\Frontend
 * @Route("/file")
 */
class FileController extends Controller
{
    /**
     * @Route("/upload", name="file_upload")
     * @Template("frontend/File/upload.html.twig")
     */
    public function uploadAction(Request $request)
    {
        $file = new File();
        $user = $this->getUser();
        if ($user instanceof User) {
            $form = $this->createForm(new CreateFileType(), $file);
        } else {
            $form = $this->createForm(new CreateFileAnonType(), $file);
        }

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $this->get( 'gedmo.listener.uploadable' )->addEntityFileInfo( $file, new UploadedFileInfo($file->getName()) );

            $em->persist($file);
            $em->flush();

            $this->container->get('event_dispatcher')->dispatch(FileEvents::SUBMITTED, new FileEvent($file));

            if($file->getScanStatus()==File::SCAN_STATUS_OK) {
                $this->addFlash('success', $this->get('translator')->trans('upload.success', array('%file%' => $file)));
            } else if($file->getScanStatus()==File::SCAN_STATUS_FAILED) {
                $this->addFlash('danger', $this->get('translator')->trans('upload.failed', array('%file%' => $file)));
            } else {
                $this->addFlash('danger', $this->get('translator')->trans('upload.virus', ['%file%' => $file]));
            }

            return $this->redirectToRoute('homepage');
        }

        return [
            'form' => $form->createView(),
        ];
    }

    /**
     * @Route("/{slug}/delete", name="file_delete")
     */
    public function deleteAction(File $file)
    {
        $this->denyAccessUnlessGranted('DELETE', $file);

        $em = $this->getDoctrine()->getManager();
        $em->remove($file);
        $em->flush();

        $this->addFlash('success', $this->get('translator')->trans('alert.file_delete_ok', array('%file%' => $file)));

        return $this->redirectToRoute('homepage');
    }

    /**
     * @Route("/{slug}", name="file_show")
     * @Method(methods={"GET"})
     * @Template("frontend/File/show.html.twig")
     */
    public function showAction(File $file)
    {
        if (false === $this->isGranted('ACCESS', $file)) {
            $this->addFlash('warning', $this->get('translator')->trans('alert.login_required'));

            return $this->render("frontend/File/show_with_login.html.twig", [
                'file' => $file,
            ]);
        }

        if (false === $this->isGranted('DOWNLOAD', $file)) {
            $form = $this->createDownloadFileForm($file);

            return $this->render("frontend/File/show_with_password.html.twig", [
                'file' => $file,
                'form' => $form->createView(),
            ]);
        }

        return [
            'file' => $file,
        ];
    }

    /**
     * @Route("/{slug}", name="file_check")
     * @Method(methods={"POST"})
     * @Template("frontend/File/show.html.twig")
     */
    public function checkPasswordAction(File $file, Request $request)
    {
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $session = $this->get('session');

        if (false === $this->isGranted( 'DOWNLOAD', $file )) {
            $form = $this->createDownloadFileForm($file);
            $form->handleRequest($request);

            if ($form->isValid()) {

                if ($user instanceof User) {
                    $file->addSharedWith($user);
                    $em->persist($file);
                    $em->flush();
                } else {
                    $session->set($file->getSlug(), true);
                }

                $this->addFlash('success', $this->get('translator')->trans('alert.valid_password'));
            } else {
                $this->addFlash('danger', $this->get('translator')->trans('alert.invalid_password'));

                return $this->render("frontend/File/show_with_password.html.twig", [
                    'file' => $file,
                    'form' => $form->createView(),
                ]);
            }
        }

        return [
            'file' => $file,
        ];
    }

    private function createDownloadFileForm($file)
    {
        $factory = $this->get('security.encoder_factory');
        if ($this->getUser() instanceof User) {
            $type = new DownloadFileType($factory);
        } else {
            $type = new DownloadFileAnonType($factory);
        }

        return $this->createForm($type, $file);
    }

    /**
     * @Route("/{slug}/download", name="file_download")
     */
    public function downloadAction(File $file)
    {
        if (false === $this->isGranted('DOWNLOAD', $file)) {
            return $this->redirectToRoute("file_show", ['slug' => $file->getSlug()]);
        }

        $fileToDownload = $file->getPath();
        $response = new BinaryFileResponse($fileToDownload);
        $response->trustXSendfileTypeHeader();
        $response->setContentDisposition(
            ResponseHeaderBag::DISPOSITION_ATTACHMENT,
            $file->getName(),
            iconv('UTF-8', 'ASCII//TRANSLIT', $file->getName())
        );
        $this->container->get('event_dispatcher')->dispatch(FileEvents::DOWNLOADED, new FileEvent($file));

        return $response;
    }

    /**
     * @Route("/{slug}/share/{shareCode}", name="file_share")
     * @Template("frontend/File/show.html.twig")
     */
    public function shareAction(File $file)
    {
        $user = $this->getUser();
        $session = $this->get('session');
        $em = $this->getDoctrine()->getManager();

        if (false === $this->get('security.authorization_checker')->isGranted('access', $file)) {
            if ($user instanceof User) {
                if(false === $file->hasAccess($user)){
                    $file->addSharedWith($user);
                    $em->persist($file);
                    $em->flush();
                }
            } else {
                $session->set($file->getSlug(), true);
            }
        }

        return array(
            'file' => $file,
        );
    }
}