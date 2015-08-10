<?php
/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 09/08/15
 * Time: 12:06
 */

namespace AppBundle\EventListener;


use AppBundle\Doctrine\Extensions\UploadedFileInfo;
use AppBundle\Entity\File;
use AppBundle\Entity\Folder;
use AppBundle\Event\FileEvent;
use AppBundle\Event\FileEvents;
use Oneup\UploaderBundle\Event\PostUploadEvent;
use Oneup\UploaderBundle\Event\PreUploadEvent;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\File\Exception\UploadException;
use Symfony\Component\Security\Csrf\CsrfToken;

class UploadListener
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function onPreUpload(PreUploadEvent $event)
    {
        $request = $event->getRequest();
        $bearer_token = $request->headers->get('X-Consigna-Bearer');

        $csrf_token = new CsrfToken('upload', $bearer_token);
        if (false === $this->container->get('security.csrf.token_manager')->isTokenValid($csrf_token) ) {
            $event->stopPropagation();
            throw new UploadException('Invalid CSRF Token');
        }

        $folder_id = $request->headers->get('X-Consigna-Folder');
        $folder = $this->container->get('consigna.doctrine_orm.folder_repository')->findOneBy(['id' => $folder_id]);
        if (!$folder || !$this->container->get('security.authorization_checker')->isGranted('UPLOAD', $folder)) {
            $event->stopPropagation();
            throw new UploadException('Access denied');
        }
    }

    public function onUpload(PostUploadEvent $event)
    {
        $request = $event->getRequest();
        $folder_id = $request->headers->get('X-Consigna-Folder');
        /** @var Folder $folder */
        $folder = $this->container->get('consigna.doctrine_orm.folder_repository')->findOneBy(['id' => $folder_id]);

        $file = new File();
        $file->setFolder($folder);
        $file->setName($event->getFile());
        $this->container->get('gedmo.listener.uploadable')->addEntityFileInfo($file, new UploadedFileInfo($file->getName()));

        $em = $this->container->get('doctrine')->getManager();
        $em->persist($file);
        $em->flush();

        $this->container->get('event_dispatcher')->dispatch(FileEvents::SUBMITTED, new FileEvent($file));

        switch($file->getScanStatus()) {
            case FILE::SCAN_STATUS_FAILED:
                throw new UploadException($this->container->get('translator')->trans('upload.failed'));
                break;
            case FILE::SCAN_STATUS_INFECTED:
                throw new UploadException($this->container->get('translator')->trans('upload.virus'));
                break;
        }
    }
}