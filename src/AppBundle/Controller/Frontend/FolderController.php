<?php

/**
 * Created by PhpStorm.
 * User: laboratorio
 * Date: 16/03/15
 * Time: 17:46.
 */

namespace AppBundle\Controller\Frontend;

use AppBundle\Entity\Folder;
use AppBundle\Entity\File;
use AppBundle\Form\Type\CreateFolderType;
use AppBundle\Form\Type\CreateFileType;
use AppBundle\Form\Type\CreateFileAnonType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

class FolderController extends Controller
{
    /**
     * @Route("folder/s/{shareCode}/{slug}", name="folder_share")
     */
    public function ShareFileAction(Folder $folder)
    {
        $user = $this->getUser();
        $session = $this->get('session');
        $em = $this->getDoctrine()->getManager();

        if (false === $this->get('security.authorization_checker')->isGranted('access', $folder)) {
            if ($user) {
                $folder->addUsersWithAccess($user);
                $em->persist($folder);
                $em->flush();
            } else {
                $session->set($folder->getSlug(), true);
            }
        }

        return $this->render(
            'Default/Folder/share.html.twig',
            array(
                'folder' => $folder,
            )
        );
    }

    /**
     *@Route("/folder/{slug}/uploadFile" , name="uploadFile_folder")
     */
    public function createFileAction(Request $request, Folder $folder)
    {
        if ($folder->getUser() != $this->getUser()) {
            $this->redirectToRoute('folder_files');
        }
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
            $file->setFolder($folder);
            $em->persist($file);

            $uploadableManager = $this->get('stof_doctrine_extensions.uploadable.manager');
            $uploadableManager->markEntityToUpload($file, $file->getFilename());

            $em->flush();

            $this->get('session')->getFlashBag()->set('success', 'File '.$file.' has been created successfully');

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
     *@Route("/folder/create" , name="folder_create")
     */
    public function createFolderAction(Request $request)
    {
        $folder = new Folder();

        if (false === $this->get('security.authorization_checker')->isGranted('create', $folder)) {
            throw $this->createAccessDeniedException();
        }

        $user = $this->getUser();

        $form = $this->createForm(new CreateFolderType(), $folder);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $folder->setUser($user);
            $em->persist($folder);
            $em->flush();

            $this->get('session')->getFlashBag()->set('success', 'Folder '.$folder.' has been created successfully');

            return $this->redirectToRoute('homepage');
        }

        return $this->render(
            'Default/form.html.twig',
            array(
                'form' => $form->createView(),
            ));
    }

    /**
     *@Route("/folder/{slug}/control" , name="control_access")
     */
    public function controlAccessAction(Folder $folder)
    {
        if (true === $this->get('security.authorization_checker')->isGranted('access', $folder)) {
            return $this->redirectToRoute('folder_files', array('slug' => $folder->getSlug()));
        } else {
            return $this->redirectToRoute('folder_validation_form', array('slug' => $folder->getSlug()));
        }
    }

    /**
     *@Route("/folder/{slug}" , name="folder_files")
     */
    public function listFolderAction(Folder $folder)
    {
        if ($this->getUser()) {
            $this->get('session')->clear();
        }
        if ($folder->hasAccess($this->getUser()) or $this->get('session')->has($folder->getSlug())) {
            return $this->render(
                'Default/listFolder.html.twig',
                array(
                    'folder' => $folder,
                )
            );
        }

        return $this->redirectToRoute('control_access', array('slug' => $folder->getSlug()));
    }

    /**
     * @Route("/folder/{slug}/delete", name="folder_delete")
     */
    public function deleteFolderAction(Folder $folder)
    {
        if (false === $this->get('security.authorization_checker')->isGranted('delete', $folder)) {
            throw $this->createAccessDeniedException();
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($folder);
        $em->flush();

        $this->get('session')->getFlashBag()->set('success', 'Folder deleted successfully');

        return $this->redirectToRoute('homepage');
    }

    /**
     * @Route("/folder/file/{slug}/download", name="file_download_in_folder")
     */
    public function downloadFileAction(File $file)
    {
        if ($this->getUser()) {
            $this->get('session')->clear();
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
}
