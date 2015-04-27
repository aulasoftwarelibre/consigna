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
use AppBundle\Form\Type\EditFolderType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Class FolderController
 * @package AppBundle\Controller\Frontend
 * @Route("/folder")
 */
class FolderController extends Controller
{
    /**
     * @Route("/new" , name="folder_new")
     * @Template("frontend/Folder/new.html.twig")
     */
    public function newAction(Request $request)
    {
        $folder = new Folder();
        $this->denyAccessUnlessGranted('CREATE', $folder);

        $user = $this->getUser();

        $form = $this->createForm(new CreateFolderType(), $folder);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $folder->setUser($user);
            $em->persist($folder);
            $em->flush();

            $this->addFlash('success', $this->get('translator')->trans('create.success', ['folder' => $folder ]));

            return $this->redirectToRoute('homepage');
        }

        return [
            'form' => $form->createView(),
        ];
    }

    /**
     * @Route("/{slug}/delete", name="folder_delete")
     */
    public function deleteAction(Folder $folder)
    {
        $this->denyAccessUnlessGranted('DELETE', $folder);

        $em = $this->getDoctrine()->getManager();
        $em->remove($folder);
        $em->flush();

        $this->addFlash('success', $this->get('translator')->trans('delete.success', ['folder' => $folder ]));

        return $this->redirectToRoute('homepage');
    }

    /**
     * TODO
     *
     * @Route("/{slug}" , name="folder_show")
     * @Method(methods={"GET"})
     * @Template("frontend/Folder/show.html.twig")
     */
    public function showAction(Folder $folder)
    {
        if (false === $this->isGranted('access', $folder)) {
            return $this->render("frontend/Folder/show_with_password.html.twig", [
                'folder' => $folder,
            ]);
        }

        return [
            'folder' => $folder,
        ];
    }





    /**
     * @Route("/{slug}/share" , name="folder_share")
     * @Template("frontend/Folder/share.html.twig")
     */
    public function shareAction(Folder $folder, Request $request)
    {
        $this->denyAccessUnlessGranted('SHARE', $folder);

        $form = $this->createForm(new EditFolderType(), $folder);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($folder);
            $em->flush();

            $this->addFlash('success', $this->get('translator')->trans('edit.success', array('folder' => $folder)));

            return $this->redirectToRoute("folder_show", ['slug' => $folder->getSlug()]);
        }

        return [
            'folder' => $folder,
            'form' => $form->createView(),
        ];
    }







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
        return $this->redirectToRoute('folder_files', array('slug' => $folder->getSlug()));
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

            $this->get('session')->getFlashBag()->set('success', $this->get('translator')->trans('upload.success', array('file' => $file)));


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
