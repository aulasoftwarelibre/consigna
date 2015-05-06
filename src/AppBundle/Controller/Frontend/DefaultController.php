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
     * @Template("frontend/Default/homepage.html.twig")
     */
    public function filesListAction()
    {
        $em = $this->getDoctrine()->getManager();
        $files = $em->getRepository('AppBundle:File')->listFiles();
        $folders = $em->getRepository('AppBundle:Folder')->findBy(array(), array('folderName' => 'ASC'));
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $sizeAndNumOfFiles= $em->getRepository('AppBundle:File')->sizeAndNumOfFiles();

        return [
            'files' => $files,
            'folders' => $folders,
            'user' => $user,
            'sum' => $sizeAndNumOfFiles,
        ];
    }

    /**
     * @Route("/user/files", name="user_files")
     * @Template("frontend/Default/homepage.html.twig")
     */
    public function myFilesAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $folders = $em->getRepository('AppBundle:Folder')->myFolders($user);
        $sizeAndNumOfFiles= $em->getRepository('AppBundle:File')->sizeAndNumOfFiles();
        $files = $em->getRepository('AppBundle:File')->myFiles($user);

        return [
            'files' => $files,
            'folders' => $folders,
            'user' => $user,
            'sum' => $sizeAndNumOfFiles,
        ];
    }

    /**
     * @Route("/find", name="find")
     * @Template("frontend/Default/homepage.html.twig")
     */
    public function findFileAction(Request $request)
    {
        $word = $request->get('word');
        $em = $this->getDoctrine()->getManager();
        $files = $em->getRepository('AppBundle:File')->findFiles($word);
        $folders = $em->getRepository('AppBundle:Folder')->findFolders($word);
        $user = $this->get('security.token_storage')->getToken()->getUser();

        return [
            'files' => $files,
            'folders' => $folders,
            'user' => $user,
        ];
    }

    /**
     * @Route("/user/shared_elements", name="shared_elements")
     * @Template("frontend/Default/homepage.html.twig")
     */
    public function sharedWithMeAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $folders = $em->getRepository('AppBundle:Folder')->findSharedFolders($user);
        $files = $em->getRepository('AppBundle:File')->findSharedFiles($user);
        $sizeAndNumOfFiles= $em->getRepository('AppBundle:File')->sizeAndNumOfFiles();

        return [
            'files' => $files,
            'folders' => $folders,
            'sum' => $sizeAndNumOfFiles,
            'user' => $user,
        ];
    }
}
