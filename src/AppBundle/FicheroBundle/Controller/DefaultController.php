<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{

    public function listaFicherosAction($fichero){
        $em = $this->getDoctrine()->getManager();
        $ficheros = $em->getRepository('FicheroBundle:Fichero')->findAll();

        return $this->render(
            'FicheroBundle:Default:listaFicheros.html.twig',
            array(
                'ficheros'     => $ficheros
            )
        );
    }
}
