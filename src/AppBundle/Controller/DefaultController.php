<?php

namespace AppBundle\Controller;


use AppBundle\Entity\File;
use AppBundle\Entity\Folder;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\Session\Session;





class DefaultController extends Controller
{
    /**
     *@Route("/" , name="files")
     */
    public function filesListAction()
    {
        $em = $this->getDoctrine()->getManager();
        $files = $em->getRepository('AppBundle:File')->findAllOrderedByName();
        $folders = $em->getRepository('AppBundle:Folder')->findAllOrderedByName();

        return $this->render(
            'Default/filesList.html.twig',
            array(
                'files' => $files,
                'folders' => $folders
            )
        );
    }

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
     * @Route("/file/{slug}/delete", name="file_delete")
     */
    public function deleteFileAction(File $file)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();

        if (!$user || !$file->getUser() || $user != $file->getUser()) {
            throw $this->createAccessDeniedException();
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($file);
        $em->flush();

        $this->get('session')->getFlashBag()->set('success', 'File deleted successfully');

        return $this->redirectToRoute('files');
    }

    /**
     * @Route("/find", name="find")
     *
     */
    public function findFileAction(Request $request)
    {
        $word = $request->get('word');
        $em=$this->getDoctrine()->getManager();
        $foundFiles= $em->getRepository('AppBundle:File')->findFiles($word);
        $foundFolders= $em->getRepository('AppBundle:Folder')->findFolders($word);

        return $this->render(
            'Default/filesList.html.twig', array(
               'files' => $foundFiles,
               'folders' => $foundFolders
        ));
    }

    /**
     * @Route("/user/files", name="user_files")
     */

    public function myFilesAction()
    {
        $user=$this->getUser();

        return $this->render(
            'Default/filesList.html.twig', array(
            'files' => $user->getFiles(),
            'folders'=> $user->getFolders()
        ));
    }

    /**
     * @Route("/user/shared_elements", name="shared_elements")
     */
    public function sharedWithMeAction()
    {
        $em = $this->getDoctrine()->getManager();
        $folders = $em->getRepository('AppBundle:Folder')->findAllOrderedByName();
        $files = $em->getRepository('AppBundle:File')->findAllOrderedByName();
        return $this->render(
            'Default/listShared.html.twig', array(
            'folders'=> $folders,
            'files' => $files
        ));
    }
}