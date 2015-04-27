<?php

namespace AppBundle\Controller\Frontend;

use AppBundle\Entity\File;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\Type\CreateFileType;
use AppBundle\Form\Type\CreateFileAnonType;
use AppBundle\Event\FileEvent;
use AppBundle\FileEvents;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Class FileController
 * @package AppBundle\Controller\Frontend
 * @Route("/file")
 */
class FileController extends Controller
{
    /**
     * @Route("/upload" , name="file_upload")
     * @Template("frontend/File/upload.html.twig")
     */
    public function uploadAction(Request $request)
    {
        $file = new File();
        $user = $this->getUser();
        if (!$user) {
            $form = $this->createForm(new CreateFileAnonType(), $file);
        } else {
            $form = $this->createForm(new CreateFileType(), $file);
        }

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            if ($user) {
                $file->setUser($user);
            }
            $em->persist($file);

            $this->get('stof_doctrine_extensions.uploadable.manager')->markEntityToUpload($file, $file->getFilename());

            $em->flush();

            $this->container->get('event_dispatcher')->dispatch(FileEvents::SUBMITTED, new FileEvent($file));

            if($file->getScanStatus()==File::SCAN_STATUS_OK) {
                $this->addFlash('success', $this->get('translator')->trans('upload.success', array('file' => $file)));
            } else if($file->getScanStatus()==File::SCAN_STATUS_FAILED) {
                $this->addFlash('success', $this->get('translator')->trans('upload.failed', array('file' => $file)));
            } else {
                $this->addFlash('success', $this->get('translator')->trans('upload.virus', ['file' => $file]));
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
        $this->denyAccessUnlessGranted('delete', $file);

        $em = $this->getDoctrine()->getManager();
        $em->remove($file);
        $em->flush();

        $this->addFlash('success', $this->get('translator')->trans('delete.success', array('file' => $file)));

        return $this->redirectToRoute('homepage');
    }

    /**
     * TODO
     *
     * @Route("/{slug}", name="file_show")
     * @Template("frontend/File/show.html.twig")
     */
    public function showAction(File $file)
    {
        if (true || false === $this->isGranted('access', $file)) {
            return $this->render("frontend/File/show_with_password.html.twig", [
                'file' => $file,
            ]);
        }

        return [
            'file' => $file,
        ];
    }

    /**
     * @Route("/{slug}/download", name="file_download")
     */
    public function downloadAction(File $file)
    {
        if (false === $this->isGranted('access', $file)) {
            return $this->redirectToRoute("file_show", ['slug' => $file->getSlug()]);
        }

        $fileToDownload = $file->getPath();
        $response = new BinaryFileResponse($fileToDownload);
        $response->trustXSendfileTypeHeader();
        $response->setContentDisposition(
            ResponseHeaderBag::DISPOSITION_ATTACHMENT,
            $file->getFilename(),
            iconv('UTF-8', 'ASCII//TRANSLIT', $file->getFilename())
        );

        return $response;
    }

    /**
     * TODO
     *
     * @Route("/{slug}/share/{shareCode}", name="file_share")
     * @Template("frontend/File/show.html.twig")
     */
    public function shareAction(File $file)
    {
        $user = $this->getUser();
        $session = $this->get('session');
        $em = $this->getDoctrine()->getManager();

        if (false === $this->get('security.authorization_checker')->isGranted('access', $file)) {
            if ($user) {
                $file->addUsersWithAccess($user);
                $em->persist($file);
                $em->flush();
            } else {
                $session->set($file->getSlug(), true);
            }
        }

        return array(
            'file' => $file,
        );
    }
}
