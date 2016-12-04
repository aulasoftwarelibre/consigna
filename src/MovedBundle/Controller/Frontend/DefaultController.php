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
     * @Route("/" , name="homepage")
     * @Template("frontend/Default/homepage.html.twig")
     */
    public function defaultAction()
    {
        $folders = $this->get('consigna.repository.folder')->findActiveFoldersBy();
        $files = $this->get('consigna.repository.file')->findActiveFilesBy();

        return [
            'files' => $files,
            'folders' => $folders,
        ];
    }

    /**
     * @Route("/user/files", name="user_files")
     * @Template("frontend/Default/homepage.html.twig")
     */
    public function myFilesAction()
    {
        $user = $this->getUser();
        $folders = $this->get('consigna.repository.folder')->findActiveFoldersBy(['owner' => $user]);
        $files = $this->get('consigna.repository.file')->findActiveFilesBy(['owner' => $user]);

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
        $folders = $this->get('consigna.repository.folder')->findActiveFoldersBy(['search' => $word]);
        $files = $this->get('consigna.repository.file')->findActiveFilesBy(['search' => $word]);

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
        $folders = $this->get('consigna.repository.folder')->findActiveFoldersBy(['shared' => $user]);
        $files = $this->get('consigna.repository.file')->findActiveFilesBy(['shared' => $user]);

        return [
            'files' => $files,
            'folders' => $folders,
        ];
    }

    /**
     * Creates a form to delete a entity.
     *
     * @return \Symfony\Component\Form\Form The form
     */
    public function createDeleteFormAction()
    {
        $deleteForm = $this->createFormBuilder()
            ->setMethod('DELETE')
            ->getForm()
        ;

        return $this->render(':frontend/Default:delete.html.twig', [
            'delete_form' => $deleteForm->createView(),
        ]);
    }
}
