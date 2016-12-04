<?php

/**
 * Created by PhpStorm.
 * User: laboratorio
 * Date: 16/03/15
 * Time: 17:46.
 */

namespace MovedBundle\Controller\Frontend;

use MovedBundle\Controller\Controller;
use MovedBundle\Event\ConsignaEvents;
use MovedBundle\Event\FolderEvent;
use MovedBundle\Event\UserAccessSharedEvent;
use AppBundle\Entity\Folder;
use AppBundle\Form\Type\FolderAccessType;
use AppBundle\Form\Type\FolderAnonAccessType;
use AppBundle\Form\Type\FolderCreateType;
use AppBundle\Form\Type\FolderEditType;
use AppBundle\Entity\Organization;
use Bundle\UserBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class FolderController.
 *
 * @Route("/folder")
 */
class FolderController extends Controller
{
    /**
     * @Method({"GET"})
     * @Route("/s/{sharedCode}", name="folder_access_share")
     */
    public function accessShareAction(Folder $folder)
    {
        if (false === $this->isGranted('ACCESS', $folder)) {
            $this->dispatch(ConsignaEvents::FOLDER_ACCESS_SUCCESS, new UserAccessSharedEvent($folder, $this->getUser()));
        }

        return $this->redirectToRoute(
            'folder_show',
            [
                'slug' => $folder->getSlug(),
            ]
        );
    }

    /**
     * @Method(methods={"POST"})
     * @ParamConverter("folder", options={"repository_method" = "findOneActiveBySlug"})
     * @Route("/{slug}/show", name="folder_check_password")
     */
    public function checkPasswordAction(Folder $folder, Request $request)
    {
        if (false === $this->isGranted('ACCESS', $folder)) {
            $form = $this->createAccessFolderForm($folder);
            $form->handleRequest($request);

            if ($form->isValid()) {
                $this->dispatch(ConsignaEvents::FOLDER_ACCESS_SUCCESS, new UserAccessSharedEvent($folder, $this->getUser()));
                $this->dispatch(ConsignaEvents::CHECK_PASSWORD_SUCCESS, new FolderEvent($folder));
            } else {
                return $this->render(
                    'frontend/Folder/show_with_password.html.twig',
                    [
                        'folder' => $folder,
                        'form' => $form->createView(),
                    ]
                );
            }
        }

        return $this->redirectToRoute('folder_show', ['slug' => $folder->getSlug()]);
    }

    /**
     * @Method({"DELETE"})
     * @ParamConverter("folder", options={"repository_method" = "findOneActiveBySlug"})
     * @Route("/{slug}/delete", name="folder_delete")
     * @Security("is_granted('DELETE', folder)")
     */
    public function deleteAction(Folder $folder, Request $request)
    {
        $form = $this->createDeleteForm();
        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->delete($folder);
            $this->dispatch(ConsignaEvents::FOLDER_DELETE_SUCCESS, new FolderEvent($folder));

            return $this->redirectToRoute('homepage');
        }

        $this->dispatch(ConsignaEvents::FOLDER_DELETE_ERROR, new FolderEvent($folder));

        return $this->redirectToRoute('homepage');
    }

    /**
     * @Method({"GET", "POST"})
     * @Route("/new" , name="folder_new")
     * @Security("has_role('ROLE_USER')")
     */
    public function newAction(Request $request)
    {
        $folder = $this->get('consigna.factory.folder')->createNew();

        $form = $this->createForm(FolderCreateType::class, $folder);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->get('consigna.manager.folder')->createFolder($folder);

            return $this->redirectToRoute('folder_show', ['slug' => $folder->getSlug()]);
        }

        return $this->render(
            'frontend/Folder/new.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @Method({"GET", "POST"})
     * @ParamConverter("folder", options={"repository_method" = "findOneActiveBySlug"})
     * @Route("/{slug}/share" , name="folder_share")
     * @Security("is_granted('SHARE', folder)")
     */
    public function shareAction(Folder $folder, Request $request)
    {
        $organization = new Organization();
        $organization = $this->get('consigna.factory.organization')->createNew();

        $form = $this->createForm(FolderEditType::class, $folder);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->save($folder);
            $this->dispatch(ConsignaEvents::FOLDER_UPDATE_SUCCESS, new FolderEvent($folder));

            return $this->redirectToRoute('folder_show', ['slug' => $folder->getSlug()]);
        }

        $files = $this->get('consigna.repository.file')->findActiveFilesBy(['folder' => $folder]);

        return $this->render(
            'frontend/Folder/share.html.twig',
            [
                'files' => $files,
                'folder' => $folder,
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @Method({"GET"})
     * @ParamConverter("folder", options={"repository_method" = "findOneActiveBySlug"})
     * @Route("/{slug}/show", name="folder_show")
     */
    public function showAction(Folder $folder)
    {
        if (false === $this->isGranted('ACCESS', $folder)) {
            $form = $this->createAccessFolderForm($folder);

            return $this->render(
                'frontend/Folder/show_with_password.html.twig',
                [
                    'folder' => $folder,
                    'form' => $form->createView(),
                ]
            );
        }

        $files = $this->get('consigna.repository.file')->findActiveFilesBy(['folder' => $folder]);

        return $this->render(
            'frontend/Folder/show.html.twig',
            [
                'files' => $files,
                'folder' => $folder,
            ]
        );
    }

    /**
     * @param $folder
     *
     * @return \Symfony\Component\Form\Form
     */
    private function createAccessFolderForm($folder)
    {
        if ($this->getUser() instanceof User) {
            return $this->createForm(FolderAccessType::class, $folder);
        } else {
            return $this->createForm(FolderAnonAccessType::class, $folder);
        }
    }
}
