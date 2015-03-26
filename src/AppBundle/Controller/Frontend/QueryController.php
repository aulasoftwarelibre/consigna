<?php

namespace AppBundle\Controller\Frontend;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\Session\Session;



class QueryController extends Controller{

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
//        $user=$this->getUser();
//
//        return $this->render(
//            'Default/filesList.html.twig', array(
//            'files' => $user->getFiles(),
//            'folders'=> $user->getFolders()
//        ));
//        it's been changed because it doesn't understand $user->getFiles or $user->getFolders as null

        $em = $this->getDoctrine()->getManager();
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $folders = $em->getRepository('AppBundle:Folder')->myFolders($user);
        $files = $em->getRepository('AppBundle:File')->myFiles($user);

        return $this->render(
            'Default/listShared.html.twig', array(
            'folders'=> $folders,
            'files' => $files
        ));

    }

    /**
     * @Route("/user/shared_elements", name="shared_elements")
     */
    public function sharedWithMeAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $folders = $em->getRepository('AppBundle:Folder')->findSharedFolders($user);
        $files = $em->getRepository('AppBundle:File')->findSharedFiles($user);

        return $this->render(
            'Default/listShared.html.twig', array(
            'folders'=> $folders,
            'files' => $files
        ));
    }
}
