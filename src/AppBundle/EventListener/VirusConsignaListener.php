<?php
/**
 * Created by PhpStorm.
 * User: juanan
 * Date: 15/04/15
 * Time: 23:28
 */

namespace AppBundle\EventListener;

use AppBundle\FileEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use AppBundle\Event\FileEvent;
use Psr\Log\LoggerInterface;



class VirusConsignaListener implements EventSubscriberInterface
{
    /**
     * @var LoggerInterface
     */
    private $loggerInterface;

    function __construct(LoggerInterface $loggerInterface)
    {
        $this->loggerInterface = $loggerInterface;
    }

    /**
     * Returns an array of events this subscriber wants to listen to.
     *
     * @return array
     */
    /**
     * Returns an array of event names this subscriber wants to listen to.
     *
     * The array keys are event names and the value can be:
     *
     *  * The method name to call (priority defaults to 0)
     *  * An array composed of the method name to call and the priority
     *  * An array of arrays composed of the method names to call and respective
     *    priorities, or 0 if unset
     *
     * For instance:
     *
     *  * array('eventName' => 'methodName')
     *  * array('eventName' => array('methodName', $priority))
     *  * array('eventName' => array(array('methodName1', $priority), array('methodName2'))
     *
     * @return array The event names to listen to
     *
     * @api
     */
    public static function getSubscribedEvents()
    {
        return array(
            FileEvents::SUBMITTED => 'onFileSubmitted'
        );
    }

    public function onFileSubmitted(FileEvent $event)
    {
        $file = $event->getFile();
        $this->loggerInterface->info('File '.$file.' has been scanned');

    }
}