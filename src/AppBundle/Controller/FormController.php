<?php
/**
 * Created by PhpStorm.
 * User: laboratorio
 * Date: 16/03/15
 * Time: 17:46
 */

namespace AppBundle\Controller;


use Nelmio\Alice\fixtures\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Form\Type\FolderType;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Folder;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;



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
            $user=new \AppBundle\Entity\User();

        $form = $this->createForm(new FolderType($folder,$user));
        $form->handleRequest($request);

        if($user->getUsername()!=''){
            if ($form->isValid()) {
                $folder->addUsersWithAccess($user);
                $em->persist($folder);
                $em->flush();

                return $this->render(
                    'Default/listFolder.html.twig',
                    array(
                        'folder' => $folder,
                    )
                );
            }
        }
        else {
            if ($form->isValid()) {
                $session->set($folder->getSlug(),true);
                return $this->render(
                    'Default/listFolder.html.twig',
                    array(
                        'folder' => $folder,
                    )
                );
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