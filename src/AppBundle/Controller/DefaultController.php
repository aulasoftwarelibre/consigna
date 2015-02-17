<?php

namespace AppBundle\Controller;


use AppBundle\Entity\File;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

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


        return $this->render(
            'Default/filesList.html.twig', array(
               'files' => $foundFiles
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
}