<?php

namespace AppBundle\Controller;

use AppBundle\Entity\File;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class FileController extends Controller{

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
     * @Route("/file/{slug}/download", name="file_download")
     */
    public function downloadFileAction(File $file)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();

        if (!$user || !$file->getUser() || $user != $file->getUser() || !$file->hasAccess($user)) {
            throw $this->createAccessDeniedException();
        }

        $fileToDownload = '/tmp/+~JF3656395549127195493.tmp';
        $response = new BinaryFileResponse($fileToDownload);
        $response->trustXSendfileTypeHeader();
        $response->setContentDisposition(
            ResponseHeaderBag::DISPOSITION_INLINE,
            '+~JF3656395549127195493.tmp',
            iconv('UTF-8','ASCII//TRANSLIT','+~JF3656395549127195493.tmp')
        );

        $this->get('session')->getFlashBag()->set('success', 'File downloaded successfully');
        return $response;
    }


}