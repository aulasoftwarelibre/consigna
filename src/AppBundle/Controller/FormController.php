<?php
/**
 * Created by PhpStorm.
 * User: laboratorio
 * Date: 16/03/15
 * Time: 17:46
 */

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Form\Type\FolderType;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Folder;
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

        $form = $this->createForm(new FolderType($folder,$user));
        $form->handleRequest($request);

        if($user->getUsername()!=''){
            if ($form->isValid()) {
                $folder->addUsersWithAccess($user);
                $em->persist($folder);
                $em->flush();
                return $this->redirectToRoute('folder_files',array('slug'=>$folder->getSlug()));
            }
        }
        else {
            if ($form->isValid()) {
                $session->set($folder->getSlug(),true);
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
}