<?php
/**
 * Created by PhpStorm.
 * User: laboratorio
 * Date: 16/03/15
 * Time: 17:46
 */

namespace AppBundle\Controller\Frontend;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Form\Type\AccessFolderType;
use AppBundle\Form\Type\DownloadFileType;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Folder;
use AppBundle\Entity\File;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Entity\User;



class FormController extends Controller{

    /**
     *@Route("/folder/{slug}/validation" , name="folder_validation_form")
     */
    public function folderValidationAction(Folder $folder,Request $request)
    {
        $em=$this->getDoctrine()->getManager();
        $user = $this->getUser();
        $session = $this->get('session');

        if(!$user)
            $user=new User();

        $form = $this->createForm(new AccessFolderType($folder,$user));
        $form->handleRequest($request);

        if($user->getUsername()!=''){
            if ($form->isValid()) {
                $folder->addUsersWithAccess($user);
                $em->persist($folder);
                $em->flush();
                $this->get('session')->getFlashBag()->set('success', 'Access have been granted to ' .$user);
                return $this->redirectToRoute('folder_files',array('slug'=>$folder->getSlug()));
            }
        }
        else {
            if ($form->isValid()) {
                $session->set($folder->getSlug(),true);
                $this->get('session')->getFlashBag()->set('success', 'Access have been granted');
                return $this->redirectToRoute('folder_files',array('slug'=>$folder->getSlug()));
            }
        }
        return $this->render(
            'Default/form.html.twig',
            array(
                'form' => $form->createView()
            )
        );
    }


    /**
     *@Route("/file/{slug}/download/validation" , name="download_file_validation_form")
     */
    public function downloadFileValidationAction(File $file,Request $request)
    {
        $em=$this->getDoctrine()->getManager();

        $user = $this->getUser();
        $session = $this->get('session');

        if(!$user) {
            $user = new User();
        }

        $form = $this->createForm(new DownloadFileType($file, $user));
        $form->handleRequest($request);

        if($user->getUsername()!=''){
            if ($form->isValid()) {
                $file->addUsersWithAccess($user);
                $em->persist($file);
                $em->flush();
                return $this->redirectToRoute('file_download',array('slug'=>$file->getSlug()));
            }
        }
        else {
            if ($form->isValid()) {
                $session->set($file->getSlug(),true);
                return $this->redirectToRoute('file_download',array('slug'=>$file->getSlug()));
            }
        }
        return $this->render(
            'Default/form.html.twig',
            array(
                'form' => $form->createView()
            )
        );
    }
}