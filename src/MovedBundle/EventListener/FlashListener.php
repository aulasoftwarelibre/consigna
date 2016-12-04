<?php

/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 13/08/15
 * Time: 23:19.
 */

namespace MovedBundle\EventListener;

use MovedBundle\Event\ConsignaEvents;
use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Translation\TranslatorInterface;

class FlashListener implements EventSubscriberInterface
{
    /**
     * @var Session
     */
    private $session;

    private static $successMessages = [
        ConsignaEvents::FILE_DELETE_ERROR => 'alert.file_delete_error',
        ConsignaEvents::FILE_DELETE_SUCCESS => 'alert.file_delete_ok',
        ConsignaEvents::FOLDER_DELETE_ERROR => 'alert.folder_delete_error',
        ConsignaEvents::FOLDER_DELETE_SUCCESS => 'alert.folder_delete_ok',
        ConsignaEvents::FOLDER_NEW_SUCCESS => 'alert.folder_created_ok',
        ConsignaEvents::FOLDER_UPDATE_SUCCESS => 'alert.folder_updated_ok',
        ConsignaEvents::CHECK_PASSWORD_SUCCESS => 'alert.valid_password',
    ];

    /**
     * @var TranslatorInterface
     */
    private $translator;

    /**
     * Construct.
     *
     * @param Session             $session
     * @param TranslatorInterface $translator
     */
    public function __construct(Session $session, TranslatorInterface $translator)
    {
        $this->session = $session;
        $this->translator = $translator;
    }

    public function addErrorFlash(Event $event, $eventName = null)
    {
        if (!isset(self::$successMessages[$eventName])) {
            throw new \InvalidArgumentException('This event does not correspond to a known flash message');
        }

        $this->session->getFlashBag()->add('error', $this->trans(self::$successMessages[$eventName]));
    }

    public function addSuccessFlash(Event $event, $eventName = null)
    {
        if (!isset(self::$successMessages[$eventName])) {
            throw new \InvalidArgumentException('This event does not correspond to a known flash message');
        }

        $this->session->getFlashBag()->add('success', $this->trans(self::$successMessages[$eventName]));
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents()
    {
        return [
            ConsignaEvents::CHECK_PASSWORD_SUCCESS => 'addSuccessFlash',
            ConsignaEvents::FILE_DELETE_ERROR => 'addErrorFlash',
            ConsignaEvents::FILE_DELETE_SUCCESS => 'addSuccessFlash',
            ConsignaEvents::FOLDER_DELETE_ERROR => 'addErrorFlash',
            ConsignaEvents::FOLDER_DELETE_SUCCESS => 'addSuccessFlash',
            ConsignaEvents::FOLDER_NEW_SUCCESS => 'addSuccessFlash',
            ConsignaEvents::FOLDER_UPDATE_SUCCESS => 'addSuccessFlash',
        ];
    }

    private function trans($message, array $params = [])
    {
        return $this->translator->trans($message, $params);
    }
}
