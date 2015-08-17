<?php

/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 13/08/15
 * Time: 17:41.
 */
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller as BaseController;
use Symfony\Component\EventDispatcher\Event;

class Controller extends BaseController
{
    public function addFlashTrans($type, $id, array $parameters = [], $domain = null, $locale = null)
    {
        $message = $this->trans($id, $parameters, $domain, $locale);

        $this->addFlash($type, $message);
    }

    public function addFlashTransChoice($type, $id, $number, array $parameters = [], $domain = null, $locale = null)
    {
        $message = $this->transChoice($id, $number, $parameters, $domain, $locale);

        $this->addFlash($type, $message);
    }

    public function delete($object)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($object);
        $em->flush();
    }

    public function dispatch($eventName, Event $event = null)
    {
        $dispatcher = $this->get('event_dispatcher');

        return $dispatcher->dispatch($eventName, $event);
    }

    public function save($object)
    {
        $em = $this->getDoctrine()->getManager();
        $em->persist($object);
        $em->flush();
    }

    public function trans($id, array $parameters = [], $domain = null, $locale = null)
    {
        return $this->get('translator')->trans($id, $parameters, $domain, $locale);
    }

    public function transChoice($id, $number, array $parameters = [], $domain = null, $locale = null)
    {
        return $this->get('translator')->transChoice($id, $number, $parameters, $domain, $locale);
    }

    protected function createDeleteForm()
    {
        return $this->createFormBuilder()
            ->setMethod('DELETE')
            ->getForm();
    }
}
