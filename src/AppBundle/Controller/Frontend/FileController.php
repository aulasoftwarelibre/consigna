<?php

namespace AppBundle\Controller\Frontend;

use AppBundle\Entity\File;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\Type\CreateFileType;
use AppBundle\Form\Type\CreateFileAnonType;


class FileController extends Controller{

    /**
     *@Route("/file/create" , name="file_create")
     */
    public function createFileAction(Request $request)
    {
        $file = new File();
        $user = $this->getUser();
        if (!$user) {
            $form = $this->createForm(new CreateFileAnonType(), $file);
        }
        else{
            $form = $this->createForm(new CreateFileType(), $file);
        }

        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            if($user) {
                $file->setUser($user);
            }

            $em->persist($file);

            $uploadableManager = $this->get('stof_doctrine_extensions.uploadable.manager');
            $uploadableManager->markEntityToUpload($file, $file->getFilename());

            $em->flush();

            $this->get('session')->getFlashBag()->set('success', 'File '.$file.' has been created successfully');
            return $this->redirectToRoute('homepage');
        }
        return $this->render(
            'Default/form.html.twig',
            array(
                'form' => $form->createView()
            )
        );
    }

        /**
     * @Route("/file/{slug}/delete", name="file_delete")
     */
    public function deleteFileAction(File $file)
    {
        if (false === $this->get('security.authorization_checker')->isGranted('delete', $file)) {
            throw $this->createAccessDeniedException();
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($file);
        $em->flush();

        $this->addFlash('success', 'File '.$file.' deleted successfully');

        return $this->redirectToRoute('homepage');
    }
    /**
     * @Route("/file/{slug}/download/control", name="control_file_download")
     */
    public function controlFileDownloadAction(File $file)
    {
        if (true === $this->get('security.authorization_checker')->isGranted('access', $file)) {
            return $this->redirectToRoute('file_download',array('slug'=>$file->getSlug()));
        } else {
            return $this->redirectToRoute('download_file_validation_form',array('slug'=>$file->getSlug()));
        }
    }

    /**
     * @Route("/file/{slug}/download", name="file_download")
     *
     */
    public function downloadFileAction(File $file)
    {
        if($this->getUser()) {
            $this->get('session')->clear();
        }

        if (true === $this->get('security.authorization_checker')->isGranted('access', $file)) {
            $fileToDownload = $file->getPath();
            $response = new BinaryFileResponse($fileToDownload);
            $response->trustXSendfileTypeHeader();
            $response->setContentDisposition(
                ResponseHeaderBag::DISPOSITION_ATTACHMENT,
                $file->getFilename(),
                iconv('UTF-8', 'ASCII//TRANSLIT', $file->getFilename())
            );
            return $response;
        }
        else {
            return $this->redirectToRoute('download_file_validation_form', array('slug' => $file->getSlug()));
        }
    }
}