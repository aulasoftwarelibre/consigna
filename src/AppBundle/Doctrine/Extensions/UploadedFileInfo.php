<?php

/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 05/08/15
 * Time: 06:26.
 */
namespace AppBundle\Doctrine\Extensions;

use Gedmo\Uploadable\FileInfo\FileInfoInterface;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class UploadedFileInfo implements FileInfoInterface
{
    /** @var File  */
    private $uploadedFile;

    public function __construct($uploadedFile)
    {
        $this->uploadedFile = $uploadedFile;
    }

    public function getTmpName()
    {
        return $this->uploadedFile->getPathname();
    }

    public function getName()
    {
        if ($this->uploadedFile instanceof UploadedFile) {
            return $this->uploadedFile->getClientOriginalName();
        } else {
            return $this->uploadedFile->getBasename();
        }
    }

    public function getSize()
    {
        return $this->uploadedFile->getSize();
    }

    public function getType()
    {
        return $this->uploadedFile->getMimeType();
    }

    public function getError()
    {
        if ($this->uploadedFile instanceof UploadedFile) {
            return $this->uploadedFile->getError();
        } else {
            return;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function isUploadedFile()
    {
        return is_uploaded_file($this->uploadedFile->getPathname());
    }
}
