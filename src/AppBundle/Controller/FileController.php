<?php

namespace AppBundle\Controller;

use AppBundle\Entity\File;

use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\Type\FileType;


class FileController extends Controller{

    /**
     *@Route("/file/create" , name="file_create")
     */
    public function createFileAction(Request $request)
    {
        $file = new File();
        $user = $this->getUser();
        if (!$user)
            $user=new User();
        $form = $this->createForm(new FileType($user), $file);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            if($user->getPassword()!='')
                $file->setUser($user);
            $em->persist($file);
            $em->flush();
            return $this->redirectToRoute('homepage');
        }
        return $this->render(
            'Default/form.html.twig',
            array(
                'form' => $form->createView()
            ));
    }

        /**
     * @Route("/file/{slug}/delete", name="file_delete")
     */
    public function deleteFileAction(File $file)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();

        if (!$user || !$file->getUser() || $user != $file->getUser()) {
            throw $this->createAccessDeniedException();
        }

        $em = $this->getDoctrine()->getManager();
        $em->remove($file);
        $em->flush();

        $this->get('session')->getFlashBag()->set('success', 'File deleted successfully');

        return $this->redirectToRoute('homepage');
    }
    /**
     * @Route("/file/{slug}/download/control", name="control_file_download")
     */
    public function controlFileDownloadAction(File $file)
    {
        if($file->hasAccess($this->getUser()) || $this->get('session')->has($file->getSlug()))
        {
            return $this->redirectToRoute('file_download',array('slug'=>$file->getSlug()));
        }

        return $this->redirectToRoute('download_file_validation_form',array('slug'=>$file->getSlug()));
    }

    /**
     * @Route("/file/{slug}/download", name="file_download")
     * @Security("file.hasAccess(user)")
     */
    public function downloadFileAction(File $file)
    {
        $fileToDownload = '/tmp/+~JF3326272500329802144.tmp';
        $response = new BinaryFileResponse($fileToDownload);
        $response->trustXSendfileTypeHeader();
        $response->setContentDisposition(
            ResponseHeaderBag::DISPOSITION_INLINE,
            '+~JF3326272500329802144.tmp',
            iconv('UTF-8','ASCII//TRANSLIT','+~JF3326272500329802144.tmp')
        );
        return $response;
    }
}