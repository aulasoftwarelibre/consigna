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


class FolderController extends Controller{

    /**
     *@Route("/folder/{slug}" , name="folder_files")
     */
    public function listFolderAction(Folder $folder, Request $request)
    {
        //if user is authenticated
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();

        if ($this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            if($folder->hasAccess($user)){
                return $this->render(
                    'Default/listFolder.html.twig',
                    array(
                        'folder' => $folder,
                    )
                );
            }
            else{
                $form = $this->createFormBuilder()
                    ->add('password', 'password',array(
                        'constraints' => new Assert\EqualTo(array(
                            'value' => $folder->getPassword(),
                            'message' => 'The password is not correct'
                        ))))
                    ->add('submit','submit')
                    ->getForm();

                $form->handleRequest($request);

                if ($form->isValid()) {
                    $folder->addUsersWithAccess($user);
                    $em->persist($folder);
                    return $this->render(
                        'Default/listFolder.html.twig',
                        array(
                            'folder' => $folder,
                        )
                    );
                }
                $em->flush();

                return $this->render(
                    'Default/form.html.twig',
                    array(
                        'form'=>$form->createView()
                    )
                );
            }
        }
        else {
            $session=$this->get('session');
            if ($session->has($folder->getSlug())){
                return $this->render(
                    'Default/listFolder.html.twig',
                    array(
                        'folder' => $folder,
                    )
                );
            } else {
                $form = $this->createFormBuilder()

                    ->add('password', 'password', array(
                        'constraints' => new Assert\EqualTo(array(
                            'value' => $folder->getPassword(),
                            'message' => 'The password is not correct'
                        ))))
                    ->add('captcha', 'ewz_recaptcha', array(
                            'attr' => array(
                                'options' => array(
                                    'theme' => 'light',
                                    'type'  => 'image'
                                )
                            ),
                            'mapped'      => false,
                            'constraints' => array(
                                new True()
                            )
                        ))
                    ->add('submit', 'submit')
                    ->getForm();

                $form->handleRequest($request);

                if ($form->isValid()) {
                    $session->set($folder->getSlug(),true);
                    return $this->render(
                        'Default/listFolder.html.twig',
                        array(
                            'folder' => $folder,
                        )
                    );
                }

                return $this->render(
                    'Default/form.html.twig',
                    array(
                        'form' => $form->createView()
                    )
                );
            }
        }
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