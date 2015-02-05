<?php

namespace AppBundle\Controller;

use AppBundle\Entity\File;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;

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
            'Default/filesList.html.twig',
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

    /**
     * @Route("/find/", name="find")
     *
     */
    public function findFileAction(Request $request)
    {
        $word = $request->get('word');
        $em=$this->getDoctrine()->getManager();
        $foundFiles= $em->getRepository('AppBundle:File')->findFiles($word);


        return $this->render(
            'Default/filesList.html.twig', array(
               'files' => $foundFiles
        ));
    }

    /**
     * @Route("/Login/", name="new_login")
     *
     */
    public function newLoginAction()
    {
        return $this->render(
            'Default/newLogin.html.twig');
    }
}