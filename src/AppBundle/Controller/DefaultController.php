<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/hello/{name}")
     */
    public function indexAction($name)
    {
	    return $this->render('Default/index.html.twig', array('name' => $name));

	    return array('name' => $name);
    }

    /**
     *
     * @Route("/")
     */
    public function listaFicherosAction(){
        $em = $this->getDoctrine()->getManager();
        $ficheros = $em->getRepository('AppBundle:Fichero')->findAll();
        return $this->render(
            'AppBundle:Default:listaFicheros.html.twig',
            array(
                'ficheros'     => $ficheros
            )
        );
    }
}
