<?php

namespace AppBundle\Controller\Frontend;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

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
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function consignaStatisticsAction()
    {
        $statistics = $this->get('consigna.repository.file')->sizeAndNumOfFiles();

        return $this->render('frontend/Default/statistics.html.twig',
            ['statistics' => $statistics]
        );
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
