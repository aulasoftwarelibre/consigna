<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\File;

class DefaultController extends Controller
{
    /**
     *
     * @Route("/" , name="files-list")
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
     * @Route("/delete/", name="deleteFile")
     */
    public function deleteFileAction(Request $request)
    {
        $file=$this->getDoctrine()->getRepository('AppBundle:File')->findOneByid($request->get('id'));
        $em = $this->getDoctrine()->getManager();
        $em->remove($file);
        $em->flush();

        return $this->redirectToRoute('files-list');

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
     * @Route("/my-files/", name="my-files")
     */

    public function myFilesAction()
    {
        $user=$this->getUser();



        return $this->render(
            'Default/filesList.html.twig', array(
            'files' => $user->getFiles()
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