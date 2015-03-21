<?php
/**
 * Created by PhpStorm.
 * User: laboratorio
 * Date: 16/03/15
 * Time: 17:46
 */

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;


use AppBundle\Entity\Folder;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\Session\Session;
use EWZ\Bundle\RecaptchaBundle\Validator\Constraints\True;

use AppBundle\Form\Type\FolderType;

class FolderController extends Controller{


    /**
     *@Route("/folder/{slug}" , name="control_access")
     */
    public function controlAccessAction(Folder $folder)
    {
        if($folder->hasAccess($this->getUser()) ||  $this->get('session')->has($folder->getSlug()))
        {
            return $this->render(
                'Default/listFolder.html.twig',
                array(
                    'folder' => $folder,
                )
            );
        }
        else
            return $this->redirectToRoute('folder_validation_form',array('slug'=>$folder->getSlug()));
    }

//     /**
//     *@Route("/folder/{slug}" , name="folder_files")
//     */
//    public function listFolderAction(Folder $folder)
//    {
////        $folder=$this->get('folder');
//        return $this->render(
//            'Default/listFolder.html.twig',
//            array(
//                'folder' => $folder,
//            )
//        );
//    }

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