<?php

/**
 * Created by PhpStorm.
 * User: laboratorio
 * Date: 16/03/15
 * Time: 17:46.
 */

namespace AppBundle\Controller\Frontend;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Form\Type\AccessFolderType;
use AppBundle\Form\Type\AccessFolderAnonType;
use AppBundle\Form\Type\DownloadFileType;
use AppBundle\Form\Type\DownloadFileAnonType;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Folder;
use AppBundle\Entity\File;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class FormController extends Controller
{
    /**
     *@Route("/folder/{slug}/validation" , name="folder_validation_form")
     */
    public function folderValidationAction(Folder $folder, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $session = $this->get('session');

        if (!$user) {
            $form = $this->createForm(new AccessFolderAnonType($this->get('security.encoder_factory')), $folder);
        } else {
            $form = $this->createForm(new AccessFolderType($this->get('security.encoder_factory')), $folder);
        }

        $form->handleRequest($request);

        if ($form->isValid()) {
            if ($user) {
                $folder->addUsersWithAccess($user);
                $em->persist($folder);
                $em->flush();
                $this->get('session')->getFlashBag()->set('success', 'Access have been granted to '.$user);
            } else {
                $session->set($folder->getSlug(), true);
                $this->get('session')->getFlashBag()->set('success', 'Access have been granted');
            }

            return $this->redirectToRoute('folder_files', array('slug' => $folder->getSlug()));
        }

        return $this->render(
            'Default/form.html.twig',
            array(
                'form' => $form->createView(),
            )
        );
    }

    /**
     *@Route("/file/{slug}/download/validation" , name="download_file_validation_form")
     */
    public function downloadFileValidationAction(File $file, Request $request)
    {
        if (true === $this->get('security.authorization_checker')->isGranted('access', $file)) {
            return $this->redirectToRoute('file_download', array('slug' => $file->getSlug()));
        }

        $em = $this->getDoctrine()->getManager();

        $user = $this->getUser();
        $session = $this->get('session');

        if (!$user) {
            $form = $this->createForm(new DownloadFileAnonType($this->get('security.encoder_factory')), $file);
        } else {
            $form = $this->createForm(new DownloadFileType($this->get('security.encoder_factory')), $file);
        }

        $form->handleRequest($request);
        if ($form->isValid()) {
            if ($user) {
                $file->addUsersWithAccess($user);
                $em->persist($file);
                $em->flush();
            } else {
                $session->set($file->getSlug(), true);
            }

            return $this->redirectToRoute('file_download', array('slug' => $file->getSlug()));
        }

        return $this->render(
            'Default/form.html.twig',
            array(
                'form' => $form->createView(),
            )
        );
    }
}
