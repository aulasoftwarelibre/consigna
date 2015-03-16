<?php

namespace AppBundle\Controller;




use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class DefaultController extends Controller
{
    /**
     *@Route("/" , name="homepage")
     */
    public function filesListAction()
    {
        $em = $this->getDoctrine()->getManager();
        $files = $em->getRepository('AppBundle:File')->findBy(array(), array('filename'=>'asc'));
        $folders = $em->getRepository('AppBundle:Folder')->findBy(array(),array('folderName'=>'ASC'));

        return $this->render(
            'Default/filesList.html.twig',
            array(
                'files' => $files,
                'folders' => $folders
            )
        );
    }
}