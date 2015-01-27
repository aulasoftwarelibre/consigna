<?php

namespace AppBundle\Controller;

use AppBundle\Entity\File;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


class DefaultController extends Controller
{
    /**
     *
     * @Route("/" , name="filesList")
     */
    public function filesListAction()
    {
        $em = $this->getDoctrine()->getManager();
        $files = $em->getRepository('AppBundle:File')->findAll();

        return $this->render(
            'AppBundle:Default:filesList.html.twig',
            array(
                'files' => $files
            )
        );
    }

    /**
     * @Route("/delete/{id}", name="deleteFile")
     * @Security("file.hasOwner(user)")
     */
    public function deleteFileAction(File $file)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($file);
        $em->flush();

        return $this->redirectToRoute("filesList");
    }
}