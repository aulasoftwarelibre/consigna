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

namespace AppBundle\Doctrine\Extensions;

use Gedmo\Uploadable\FileInfo\FileInfoInterface;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class UploadedFileInfo implements FileInfoInterface
{
    /** @var File */
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
