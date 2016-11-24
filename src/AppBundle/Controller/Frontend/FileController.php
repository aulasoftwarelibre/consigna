<?php

namespace AppBundle\Controller\Frontend;

use AppBundle\Controller\Controller;
use AppBundle\Doctrine\Extensions\UploadedFileInfo;
use AppBundle\Entity\File;
use AppBundle\Entity\User;
use AppBundle\Event\ConsignaEvents;
use AppBundle\Event\UserAccessSharedEvent;
use AppBundle\Form\Type\DownloadFileAnonType;
use AppBundle\Form\Type\DownloadFileType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\Type\CreateFileType;
use AppBundle\Form\Type\CreateFileAnonType;
use AppBundle\Event\FileEvent;

/**
 * Class FileController.
 *
 * @Route("/file")
 */
class FileController extends Controller
{
    /**
     * @ParamConverter("file", options={"repository_method" = "findOneActiveBySlug"})
     * @Route("/s/{shareCode}", name="file_access_share")
     */
    public function accessSharedAction(File $file)
    {
        if (false === $this->isGranted('ACCESS', $file)) {
            $this->dispatch(ConsignaEvents::FILE_ACCESS_SUCCESS, new UserAccessSharedEvent($file, $this->getUser()));
        }

        return $this->redirectToRoute(
            'file_show',
            [
                'slug' => $file->getSlug(),
            ]
        );
    }

    /**
     * @Method(methods={"POST"})
     * @ParamConverter("file", options={"repository_method" = "findOneActiveBySlug"})
     * @Route("/{slug}/show", name="file_check")
     */
    public function checkPasswordAction(File $file, Request $request)
    {
        if (false === $this->isGranted('DOWNLOAD', $file)) {
            $form = $this->createDownloadFileForm($file);
            $form->handleRequest($request);

            if ($form->isValid()) {
                $this->dispatch(ConsignaEvents::FILE_ACCESS_SUCCESS, new UserAccessSharedEvent($file, $this->getUser()));
                $this->dispatch(ConsignaEvents::CHECK_PASSWORD_SUCCESS, new FileEvent($file));
            } else {
                return $this->render(
                    'frontend/File/show_with_password.html.twig',
                    [
                        'file' => $file,
                        'form' => $form->createView(),
                    ]
                );
            }
        }

        return $this->redirectToRoute(
            'file_show',
            [
                'slug' => $file->getSlug(),
            ]
        );
    }

    /**
     * @Method({"DELETE"})
     * @ParamConverter("file", options={"repository_method" = "findOneActiveBySlug"})
     * @Route("/{slug}/delete", name="file_delete")
     * @Security("( file.getFolder() and is_granted('DELETE', file.getFolder()) ) or ( is_granted('DELETE', file) )")
     */
    public function deleteAction(File $file, Request $request)
    {
        $folder = $file->getFolder();
        $form = $this->createDeleteForm();
        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->delete($file);
            $event = ConsignaEvents::FILE_DELETE_SUCCESS;
        } else {
            $event = ConsignaEvents::FILE_DELETE_ERROR;
        }
        $this->dispatch($event, new FileEvent($file));

        if ($folder) {
            return $this->redirectToRoute('folder_show', ['slug' => $folder->getSlug()]);
        }

        return $this->redirectToRoute('homepage');
    }

    /**
     * @Method({"GET"})
     * @ParamConverter("file", options={"repository_method" = "findOneActiveBySlug"})
     * @Route("/{slug}/download", name="file_download")
     */
    public function downloadAction(File $file, Request $request)
    {
        $folder = $file->getFolder();

        if ($folder) {
            if (false === $this->isGranted('DOWNLOAD', $folder)) {
                return $this->redirectToRoute('folder_show', ['slug' => $folder->getSlug()]);
            }
        } else {
            if (false === $this->isGranted('DOWNLOAD', $file)) {
                return $this->redirectToRoute('file_show', ['slug' => $file->getSlug()]);
            }
        }

        $response = new BinaryFileResponse($file->getPath());
        $response->trustXSendfileTypeHeader();
        $response->prepare($request);
        $response->setContentDisposition(
            ResponseHeaderBag::DISPOSITION_ATTACHMENT,
            $file->getName(),
            iconv('UTF-8', 'ASCII//TRANSLIT', $file->getName())
        );

        $this->dispatch(ConsignaEvents::FILE_DOWNLOAD_SUCCESS, new FileEvent($file));

        return $response;
    }

    /**
     * @Method(methods={"GET"})
     * @ParamConverter("file", options={"repository_method" = "findOneActiveBySlug"})
     * @Route("/{slug}/show", name="file_show")
     */
    public function showAction(File $file)
    {
        if (false === $this->isGranted('ACCESS', $file)) {
            $this->addFlashTrans('warning', 'alert.login_required');

            return $this->render(
                'frontend/File/show_with_login.html.twig',
                [
                    'file' => $file,
                ]
            );
        }

        if (false === $this->isGranted('DOWNLOAD', $file)) {
            $form = $this->createDownloadFileForm($file);

            return $this->render(
                'frontend/File/show_with_password.html.twig',
                [
                    'file' => $file,
                    'form' => $form->createView(),
                ]
            );
        }

        return $this->render(
            'frontend/File/show.html.twig',
            [
                'file' => $file,
            ]
        );
    }

    /**
     * @Route("/upload", name="file_upload")
     * @Method({"GET", "POST"})
     */
    public function uploadAction(Request $request)
    {
        $file = new File();
        $form = $this->createFileForm($file);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->get('gedmo.listener.uploadable')->addEntityFileInfo($file, new UploadedFileInfo($file->getFile()));
            $this->save($file);

            $this->dispatch(ConsignaEvents::FILE_UPLOAD_SUCCESS, new FileEvent($file));

            if ($file->getScanStatus() == File::SCAN_STATUS_OK) {
                $this->addFlashTrans('success', 'upload.success', ['%file%' => $file]);
            } else {
                if ($file->getScanStatus() == File::SCAN_STATUS_FAILED) {
                    $this->addFlashTrans('danger', 'upload.failed', ['%file%' => $file]);
                } else {
                    $this->addFlashTrans('danger', 'upload.virus', ['%file%' => $file]);
                }
            }

            return $this->redirectToRoute('homepage');
        }

        return $this->render(
            'frontend/File/upload.html.twig',
            [
                'form' => $form->createView(),
            ]
        );
    }

    private function createFileForm($file)
    {
        if ($this->getUser() instanceof User) {
            return $this->createForm(CreateFileType::class, $file);
        } else {
            return $this->createForm(CreateFileAnonType::class, $file);
        }
    }

    /**
     * @param $file
     *
     * @return \Symfony\Component\Form\Form
     */
    private function createDownloadFileForm($file)
    {
        $factory = $this->get('security.encoder_factory');
        $translator = $this->get('translator');

        if ($this->getUser() instanceof User) {
            $type = new DownloadFileType($factory, $translator);
        } else {
            $type = new DownloadFileAnonType($factory, $translator);
        }

        return $this->createForm($type, $file);
    }
}
