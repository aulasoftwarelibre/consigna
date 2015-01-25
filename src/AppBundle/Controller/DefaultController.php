<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Fichero;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


class DefaultController extends Controller
{
    /**
     *
     * @Route("/" , name="listaFicheros")
     */
    public function listaFicherosAction()
    {
        $em = $this->getDoctrine()->getManager();
        $ficheros = $em->getRepository('AppBundle:Fichero')->findAll();
       # $securityContext = $this->container->get('security.context');
        #if ($securityContext->isGranted('IS_AUTHENTICATED_FULLY')) {
         #   $usuario = $this->get('security.context')->getToken()->getUser();
        #} else {
         #   $usuario = null;
        #}

        return $this->render(
            'AppBundle:Default:listaFicheros.html.twig',
            array(
                'ficheros' => $ficheros
            )
        );
    }

    /**
     * @Route("/delete/{id}", name="eliminarFichero")
     * @Security("fichero.isOwner(user)")
     */
    public function eliminarFicheroAction(Fichero $fichero)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($fichero);
        $em->flush();

        return $this->redirectToRoute("listaFicheros");
    }
}