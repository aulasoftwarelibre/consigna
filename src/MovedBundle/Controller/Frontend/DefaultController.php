<?php

namespace MovedBundle\Controller\Frontend;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class DefaultController.
 */
class DefaultController extends Controller
{
    /**
     * @Route("/user/files", name="user_files")
     * @Template("frontend/Default/homepage.html.twig")
     */
    public function myFilesAction()
    {
        $user = $this->getUser();
        $folders = $this->get('consigna.object_repository.folder')->findActiveFoldersBy(['owner' => $user]);
        $files = $this->get('consigna.object_repository.file')->findActiveFilesBy(['owner' => $user]);

        return [
            'files' => $files,
            'folders' => $folders,
        ];
    }

    /**
     * @Route("/find", name="find")
     * @Template("frontend/Default/homepage.html.twig")
     */
    public function searchAction(Request $request)
    {
        $word = $request->get('word');
        $folders = $this->get('consigna.object_repository.folder')->findActiveFoldersBy(['search' => $word]);
        $files = $this->get('consigna.object_repository.file')->findActiveFilesBy(['search' => $word]);

        return [
            'files' => $files,
            'folders' => $folders,
        ];
    }

    /**
     * @Route("/user/shared_elements", name="shared_elements")
     * @Template("frontend/Default/homepage.html.twig")
     */
    public function sharedWithMeAction()
    {
        $user = $this->getUser();
        $folders = $this->get('consigna.object_repository.folder')->findActiveFoldersBy(['shared' => $user]);
        $files = $this->get('consigna.object_repository.file')->findActiveFilesBy(['shared' => $user]);

        return [
            'files' => $files,
            'folders' => $folders,
        ];
    }

}
