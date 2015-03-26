<?php
/**
 * Created by PhpStorm.
 * User: laboratorio
 * Date: 16/03/15
 * Time: 17:46
 */

namespace AppBundle\Controller\Frontend;

use AppBundle\Entity\Folder;
use AppBundle\Entity\File;
use AppBundle\Entity\User;
use AppBundle\Form\Type\CreateFolderType;
use AppBundle\Form\Type\FileType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;




class FolderController extends Controller{

    /**
     *@Route("/folder/{slug}/uploadFile" , name="uploadFile_folder")
     *@Security("folder.getUser() == user")
     */
    public function createFileAction(Request $request,Folder $folder)
    {
        $file = new File();
        $user = $this->getUser();
        if (!$user) {
            $user = new User();
        }
        $form = $this->createForm(new FileType($user), $file);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            if($user->getPassword()!='') {
                $file->setUser($user);
            }
            $file->setFolder($folder);
            $em->persist($file);

            $uploadableManager = $this->get('stof_doctrine_extensions.uploadable.manager');
            $uploadableManager->markEntityToUpload($file, $file->getFilename());

            $em->flush();

            $this->get('session')->getFlashBag()->set('success', 'File '.$file.' has been created successfully');
            return $this->redirectToRoute('homepage');
        }
        return $this->render(
            'Default/form.html.twig',
            array(
                'form' => $form->createView()
            )
        );
    }


    /**
     *@Route("/folder/create" , name="folder_create")
     */
    public function createFolderAction(Request $request)
    {
        $folder = new Folder();
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
                'form' => $form->createView()
            ));
    }

    /**
     *@Route("/folder/{slug}/control" , name="control_access")
     */
    public function controlAccessAction(Folder $folder)
    {
        if($folder->hasAccess($this->getUser()) ||  $this->get('session')->has($folder->getSlug()))
        {
            return $this->redirectToRoute('folder_files',array('slug'=>$folder->getSlug()));
        }
        else
            return $this->redirectToRoute('folder_validation_form',array('slug'=>$folder->getSlug()));
    }

     /**
     *@Route("/folder/{slug}" , name="folder_files")
     *@Security("folder.hasAccess(user)")
     */
    public function listFolderAction(Folder $folder)
    {
        return $this->render(
            'Default/listFolder.html.twig',
            array(
                'folder' => $folder,
            )
        );
    }

    /**
     * @Route("/folder/{slug}/delete", name="folder_delete")
     */
    public function deleteFolderAction(Folder $folder)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();

        if (!$user || !$folder->getUser() || $user != $folder->getUser()) {
            throw $this->createAccessDeniedException();
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($folder);
        $em->flush();

        $this->get('session')->getFlashBag()->set('success', 'Folder deleted successfully');

        return $this->redirectToRoute('homepage');
    }
}