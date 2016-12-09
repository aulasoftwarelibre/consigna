<?php
/**
 * This file is part of the Consigna project.
 *
 * (c) Juan Antonio Martínez <juanto1990@gmail.com>
 * (c) Sergio Gómez <sergio@uco.es>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\EventListener;

use AppBundle\Entity\Interfaces\FileInterface;
use AppBundle\Entity\Interfaces\FolderInterface;
use AppBundle\Services\FileManager;
use AppBundle\Services\ObjectDirector;
use AppBundle\Security\Voter\FolderVoter;
use Oneup\UploaderBundle\Event\PostUploadEvent;
use Oneup\UploaderBundle\Event\PreUploadEvent;
use Symfony\Component\HttpFoundation\File\Exception\UploadException;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;

class FileUploadListener
{
    /**
     * @var CsrfTokenManagerInterface
     */
    private $csrfTokenManager;
    /**
     * @var ObjectDirector
     */
    private $folderDirector;
    /**
     * @var AuthorizationCheckerInterface
     */
    private $authorizationChecker;
    /**
     * @var FileManager
     */
    private $fileManager;
    /**
     * @var ObjectDirector
     */
    private $fileDirector;

    public function __construct(
        AuthorizationCheckerInterface $authorizationChecker,
        CsrfTokenManagerInterface $csrfTokenManager,
        FileManager $fileManager,
        ObjectDirector $fileDirector,
        ObjectDirector $folderDirector
    ) {
        $this->authorizationChecker = $authorizationChecker;
        $this->csrfTokenManager = $csrfTokenManager;
        $this->fileManager = $fileManager;
        $this->fileDirector = $fileDirector;
        $this->folderDirector = $folderDirector;
    }

    public function onPreUpload(PreUploadEvent $event)
    {
        $request = $event->getRequest();
        $bearer_token = $request->headers->get('X-Consigna-Bearer');

        $csrf_token = new CsrfToken('upload', $bearer_token);
        if (false === $this->csrfTokenManager->isTokenValid($csrf_token)) {
            $event->stopPropagation();
            throw new UploadException('Invalid CSRF Token');
        }

        $folder_id = $request->headers->get('X-Consigna-Folder');
        $folder = $this->folderDirector->findOneBy(['id' => $folder_id]);

        if (!$folder || !$this->authorizationChecker->isGranted(FolderVoter::UPLOAD, $folder)) {
            $event->stopPropagation();
            throw new UploadException('Access denied');
        }
    }

    public function onUpload(PostUploadEvent $event)
    {
        $request = $event->getRequest();
        $folder_id = $request->headers->get('X-Consigna-Folder');
        /** @var FolderInterface $folder */
        $folder = $this->folderDirector->findOneBy(['id' => $folder_id]);

        $file = $this
            ->fileManager
            ->createUploadedFile($event->getFile(), $folder);

        switch ($file->getScanStatus()) {
            case FileInterface::SCAN_STATUS_FAILED:
                throw new UploadException('upload.virus.failed');
                break;
            case FileInterface::SCAN_STATUS_INFECTED:
                throw new UploadException('upload.virus');
                break;
        }
    }
}
