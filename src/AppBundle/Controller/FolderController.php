<?php
/**
 * This file is part of the Consigna project.
 *
 * (c) Juan Antonio Martínez <juanto1990@gmail.com>
 * (c) Sergio Gómez <sergio@uco.es>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


namespace AppBundle\Controller;


use AppBundle\Doctrine\Annotation\Filter;
use AppBundle\Entity\Folder;
use AppBundle\Entity\Interfaces\FileInterface;
use AppBundle\Form\Type\FolderAccessType;
use AppBundle\Form\Type\FolderCreateType;
use AppBundle\Form\Type\FolderEditType;
use AppBundle\Security\Voter\FolderVoter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class FolderController
 * @package AppBundle\Controller
 *
 * @Filter({
 *     "consigna_enabled_entity",
 *     "consigna_expired_entity",
 *     "consigna_scan_clean_file",
 * })
 * @Route("/folder")
 */
class FolderController extends Controller
{
    /**
     * @param Folder $folder
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     *
     * @Method("DELETE")
     * @ParamConverter(
     *     "folder",
     *     options={
     *          "repository_method" = "findOneActiveBy",
     *     }
     * )
     * @Route(
     *     "/{slug}/delete",
     *     name="folder_delete"
     * )
     * @Security("is_granted('DELETE', folder)")
     *
     */
    public function deleteAction(Folder $folder, Request $request)
    {
        $form = $this
            ->createFormBuilder()
            ->setMethod('DELETE')
            ->getForm()
            ->handleRequest($request);

        if ($form->isValid()) {
            $this
                ->get('consigna.manager.folder')
                ->deleteFolder($folder);
            $this->addFlash('success', 'alert.folder_delete_ok');
        } else {
            $this->addFlash('error', 'alert.folder_delete_error');
        }


        return $this->redirectToRoute('homepage');
    }

    /**
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Method({"GET", "POST"})
     * @Route(
     *     "/new",
     *     name="folder_new"
     * )
     * @Security("has_role('ROLE_USER')")
     */
    public function newAction(Request $request)
    {
        $folder = $this->get('consigna.factory.folder')->createNew();

        $form = $this->createForm(FolderCreateType::class, $folder);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $this
                ->get('consigna.manager.folder')
                ->createFolder($folder);

            return $this->redirectToRoute('folder_show', [
                'slug' => $folder->getSlug(),
            ]);
        }

        return $this->render('frontend/Folder/new.html.twig',[
            'form' => $form->createView(),
        ]);
    }

    /**
     * Show files inside a folder.
     *
     * @param Folder $folder
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Method("GET")
     * @ParamConverter(
     *     "folder",
     *     options={
     *          "repository_method" = "findOneActiveBy",
     *     }
     * )
     * @Route(
     *     "/{slug}/show",
     *     name="folder_show"
     * )
     */
    public function showAction(Folder $folder)
    {
        if (false === $this->isGranted(FolderVoter::ACCESS, $folder)) {

            $form = $this->createForm(FolderAccessType::class, $folder, [
                'user' => $this->getUser(),
            ]);

            return $this->render('frontend/Folder/show_with_password.html.twig', [
                'folder' => $folder,
                'form' => $form->createView()
            ]);
        }

        $files = $folder
            ->getItems()
            ->filter(function (FileInterface $file) {
            return $file->getScanStatus() === FileInterface::SCAN_STATUS_OK;
        });

        return $this->render('frontend/Folder/show.html.twig', [
            'files' => $files,
            'folder' => $folder,
        ]);
    }

    /**
     * Ask for the folder password.
     *
     * @param Folder $folder
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @Method("POST")
     * @ParamConverter(
     *     "folder",
     *     options={
     *          "repository_method" = "findOneActiveBy",
     *     }
     * )
     * @Route(
     *     "/{slug}/show",
     *     name="folder_check_password"
     * )
     */
    public function showCheckPasswordAction(Folder $folder, Request $request)
    {
        $user = $this->getUser();

        if (false === $this->isGranted(FolderVoter::ACCESS, $folder)) {
            $form = $this->createForm(FolderAccessType::class, $folder, [
                'user' => $user,
            ]);
            $form->handleRequest($request);

            if (!$form->isValid()) {
                return $this->render('frontend/Folder/show_with_password.html.twig', [
                    'folder' => $folder,
                    'form' => $form->createView()
                ]);
            }

            $this->addFlash('success', 'alert.valid_password');
            $this
                ->get('consigna.manager.folder')
                ->sharedFolderWithUser($folder, $user);
        }

        return $this->redirectToRoute('folder_show', [
            'slug' => $folder->getSlug(),
        ]);
    }

    //TODO: Refactorize
    /**
     * @Method({"GET", "POST"})
     * @ParamConverter("folder", options={"repository_method" = "findOneActiveBySlug"})
     * @Route("/{slug}/share" , name="folder_share")
     * @Security("is_granted('SHARE', folder)")
     */
    public function shareAction(Folder $folder, Request $request)
    {
        $form = $this->createForm(FolderEditType::class, $folder);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->get('consigna.manager.folder')->createFolder($folder);

            return $this->redirectToRoute('folder_show', ['slug' => $folder->getSlug()]);
        }

        $files = $this->get('consigna.object_repository.file')->findActiveFilesBy(['folder' => $folder]);

        return $this->render(
            'frontend/Folder/share.html.twig',
            [
                'files' => $files,
                'folder' => $folder,
                'form' => $form->createView(),
            ]
        );
    }

}