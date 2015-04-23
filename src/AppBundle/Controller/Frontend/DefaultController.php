<?php

namespace AppBundle\Controller\Frontend;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class DefaultController
 * @package AppBundle\Controller\Frontend
 */
class DefaultController extends Controller
{
    /**
     *@Route("/" , name="homepage")
     */
    public function filesListAction()
    {
        $em = $this->getDoctrine()->getManager();
        $files = $em->getRepository('AppBundle:File')->listFiles();
        $folders = $em->getRepository('AppBundle:Folder')->findBy(array(), array('folderName' => 'ASC'));

        return $this->render(
            'Default/filesList.html.twig',
            array(
                'files' => $files,
                'folders' => $folders,
            )
        );
    }

    /**
     * @Route("/user/files", name="user_files")
     */
    public function myFilesAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $folders = $em->getRepository('AppBundle:Folder')->myFolders($user);
        $files = $em->getRepository('AppBundle:File')->myFiles($user);

        return $this->render(
            'Default/filesList.html.twig', array(
            'folders' => $folders,
            'files' => $files,
        ));
    }

    /**
     * @Route("/find", name="find")
     */
    public function findFileAction(Request $request)
    {
        $word = $request->get('word');
        $em = $this->getDoctrine()->getManager();
        $foundFiles = $em->getRepository('AppBundle:File')->findFiles($word);
        $foundFolders = $em->getRepository('AppBundle:Folder')->findFolders($word);

        return $this->render(
            'Default/filesList.html.twig', array(
            'files' => $foundFiles,
            'folders' => $foundFolders,
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
            'Default/filesList.html.twig', array(
            'folders' => $folders,
            'files' => $files,
        ));
    }
}
