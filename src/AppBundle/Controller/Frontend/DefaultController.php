<?php

namespace AppBundle\Controller\Frontend;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Class DefaultController
 * @package AppBundle\Controller\Frontend
 */
class DefaultController extends Controller
{
    /**
     * @Route("/" , name="homepage")
     * @Template("Default/filesList.html.twig")
     */
    public function filesListAction()
    {
        $em = $this->getDoctrine()->getManager();
        $files = $em->getRepository('AppBundle:File')->listFiles();
        $folders = $em->getRepository('AppBundle:Folder')->findBy(array(), array('folderName' => 'ASC'));

        return array(
            'files' => $files,
            'folders' => $folders,
        );

    }

    /**
     * @Route("/user/files", name="user_files")
     * @Template("Default/filesList.html.twig")
     */
    public function myFilesAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $folders = $em->getRepository('AppBundle:Folder')->myFolders($user);
        $files = $em->getRepository('AppBundle:File')->myFiles($user);

        return array(
            'folders' => $folders,
            'files' => $files,
        );
    }

    /**
     * @Route("/find", name="find")
     * @Template("Default/filesList.html.twig")
     */
    public function findFileAction(Request $request)
    {
        $word = $request->get('word');
        $em = $this->getDoctrine()->getManager();
        $foundFiles = $em->getRepository('AppBundle:File')->findFiles($word);
        $foundFolders = $em->getRepository('AppBundle:Folder')->findFolders($word);

        return array(
            'files' => $foundFiles,
            'folders' => $foundFolders,
        );
    }


    /**
     * @Route("/user/shared_elements", name="shared_elements")
     * @Template("Default/filesList.html.twig")
     */
    public function sharedWithMeAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $folders = $em->getRepository('AppBundle:Folder')->findSharedFolders($user);
        $files = $em->getRepository('AppBundle:File')->findSharedFiles($user);

        return array(
            'folders' => $folders,
            'files' => $files,
        );
    }
}
