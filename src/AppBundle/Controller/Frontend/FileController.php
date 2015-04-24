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
 */
class FileController extends Controller
{
    /**
     * @Route("file/s/{shareCode}/{slug}", name="file_share")
     * @Template("Default/shareFile.html.twig")
     */
    public function ShareFileAction(File $file)
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

    /**
     *@Route("/file/create" , name="file_create")
     */
    public function createFileAction(Request $request)
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

            $uploadableManager = $this->get('stof_doctrine_extensions.uploadable.manager');
            $uploadableManager->markEntityToUpload($file, $file->getFilename());

            $em->flush();

            // Dispatch Event
            $fileEvent = new FileEvent($file);

            $this->container->get('event_dispatcher')->dispatch(FileEvents::SUBMITTED, $fileEvent);

            if($file->getScanStatus()==1) {
                $this->get('session')->getFlashBag()->set('success',$this->get('translator')->trans('upload.success', array('file' => $file)));
            } else {
                $this->get('session')->getFlashBag()->set('success',$this->get('translator')->trans('upload.virus', array('file' => $file)));
            }

            return $this->redirectToRoute('homepage');
        }

        return $this->render(
            'Default/form.html.twig',
            array(
                'form' => $form->createView(),
            )
        );
    }

    /**
     * @Route("/file/{slug}/delete", name="file_delete")
     */
    public function deleteFileAction(File $file)
    {
        if (false === $this->get('security.authorization_checker')->isGranted('delete', $file)) {
            throw $this->createAccessDeniedException();
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($file);
        $em->flush();

        $this->addFlash('success', $this->get('translator')->trans('delete.success', array('file' => $file)));

        return $this->redirectToRoute('homepage');
    }
    /**
     * @Route("/file/{slug}/download/control", name="control_file_download")
     */
    public function controlFileDownloadAction(File $file)
    {
        if (true === $this->get('security.authorization_checker')->isGranted('access', $file)) {
            return $this->redirectToRoute('file_download', array('slug' => $file->getSlug()));
        } else {
            return $this->redirectToRoute('download_file_validation_form', array('slug' => $file->getSlug()));
        }
    }

    /**
     * @Route("/file/{slug}/download", name="file_download")
     */
    public function downloadFileAction(File $file)
    {
        if ($this->getUser()) {
            $this->get('session')->clear();
        }

        if (true === $this->get('security.authorization_checker')->isGranted('access', $file)) {
            $fileToDownload = $file->getPath();
            $response = new BinaryFileResponse($fileToDownload);
            $response->trustXSendfileTypeHeader();
            $response->setContentDisposition(
                ResponseHeaderBag::DISPOSITION_ATTACHMENT,
                $file->getFilename(),
                iconv('UTF-8', 'ASCII//TRANSLIT', $file->getFilename())
            );

            return $response;
        } else {
            return $this->redirectToRoute('download_file_validation_form', array('slug' => $file->getSlug()));
        }
    }
}
