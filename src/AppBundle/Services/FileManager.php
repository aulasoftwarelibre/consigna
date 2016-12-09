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

namespace AppBundle\Services;

use AppBundle\Entity\Interfaces\FileInterface;
use AppBundle\Entity\Interfaces\FolderInterface;
use AppBundle\Entity\Interfaces\UserInterface;
use AppBundle\EventDispatcher\FileEventDispatcher;
use AppBundle\Services\Clamav\ScanedFile;
use AppBundle\Services\Clamav\ScanFileService;
use AppBundle\Services\Clamav\ScanFileServiceInterface;
use Gedmo\Uploadable\UploadableListener;
use AppBundle\Doctrine\Extensions\UploadedFileInfo;
use Symfony\Component\HttpFoundation\File\File;

class FileManager
{
    /**
     * @var ObjectDirector
     */
    private $fileDirector;
    /**
     * @var FileEventDispatcher
     */
    private $fileEventDispatcher;
    /**
     * @var UploadableListener
     */
    private $uploadableListener;
    /**
     * @var ScanFileServiceInterface
     */
    private $scanFileService;

    public function __construct(
        ObjectDirector $fileDirector,
        FileEventDispatcher $fileEventDispatcher,
        ScanFileServiceInterface $scanFileService,
        UploadableListener $uploadableListener
    ) {
        $this->fileDirector = $fileDirector;
        $this->fileEventDispatcher = $fileEventDispatcher;
        $this->scanFileService = $scanFileService;
        $this->uploadableListener = $uploadableListener;
    }

    public function updateFile(FileInterface $file)
    {
        $this
            ->fileDirector
            ->save($file);

        return $this;
    }

    public function createUploadedFile(File $uploadedFile, FolderInterface $folder = null)
    {
        /** @var FileInterface $file */
        $file = $this
            ->fileDirector
            ->create();

        $file
            ->setFolder($folder)
            ->setName($uploadedFile);

        $this
            ->uploadableListener
            ->addEntityFileInfo($file, new UploadedFileInfo($uploadedFile));

        $this
            ->fileDirector
            ->save($file);

        $this
            ->fileEventDispatcher
            ->dispatchFileOnUploadedEvent($file);

        return $file;
    }


    public function deleteFile(FileInterface $file)
    {
        $this
            ->fileDirector
            ->remove($file);

        return $this;
    }

    public function scanFile(FileInterface $file)
    {
        try {
            $result = $this
                ->scanFileService
                ->scan($file);

            switch ($result->getStatus()) {
                case ScanedFile::OK:
                    $file->setScanStatus(FileInterface::SCAN_STATUS_OK);
                    break;
                case ScanedFile::FOUND:
                    $file->setScanStatus(FileInterface::SCAN_STATUS_INFECTED);
                    break;
                case ScanedFile::ERROR:
                    $file->setScanStatus(FileInterface::SCAN_STATUS_FAILED);
                    break;
            }
        } catch (\Exception $e) {
            $file->setScanStatus(FileInterface::SCAN_STATUS_FAILED);
        }

        $this
            ->fileDirector
            ->save($file);
    }

    public function sharedFileWithUser(FileInterface $file, ?UserInterface $user)
    {
        if ($user) {
            $file->addSharedWithUser($user);

            $this
                ->fileDirector
                ->save($file);
        }

        $this
            ->fileEventDispatcher
            ->dispatchFileOnSharedEvent($file, $user);

        return $this;
    }
}
