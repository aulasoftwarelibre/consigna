<?php

namespace AppBundle\Controller;

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
        $user = $em->getRepository('AppBundle:User')->findOneByUsername('username' => $this->getUser());
//        $folders = $em->getRepository('AppBundle:Folder')->findBy(array(),array('folderName'=>'ASC'));
        $folders = $em->getRepository('AppBundle:Folder')->findSharedFolders($user);
        $files = $em->getRepository('AppBundle:File')->findBy(array(), array('filename'=>'asc'));
        return $this->render(
            'Default/listShared.html.twig', array(
            'folders'=> $folders,
            'files' => $files
        ));
    }

}