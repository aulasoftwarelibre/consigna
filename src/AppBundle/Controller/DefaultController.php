<?php

namespace AppBundle\Controller;


use AppBundle\Entity\File;
use AppBundle\Entity\Folder;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\FormBuilder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;



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
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $em = $this->getDoctrine()->getManager();

        $defaultData = array('message' => 'Type your message here');
        $form = $this->createFormBuilder($defaultData)
            ->add('password', 'password')
            ->add('submit','submit')
            ->getForm();

        $form->handleRequest($request);

        $data = $form->getData();
        if ($form->isValid()) {
            $folder->addUsersWithAccess($user);
            $em->persist($folder);
        }
        $em->flush();


        return $this->render(
            'Default/listFolder.html.twig',
            array(
                'folder' => $folder,
                'form'=>$form->createView()
            )
        );
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