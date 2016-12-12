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


namespace AppBundle\Doctrine\Extensions\Uploader\FileInfo;


use Gedmo\Uploadable\FileInfo\FileInfoInterface;

class DataFixtureFileInfo implements FileInfoInterface
{
    /**
     * @var
     */
    private $path;

    /**
     * @inheritDoc
     */
    public function __construct($path)
    {
        if (!file_exists($path)) {
            throw new \InvalidArgumentException('Fixture file not found: '.$path);
        }

        $this->path = $path;
    }


    public function getTmpName()
    {
        return $this->path;
    }

    public function getName()
    {
        return basename($this->path);
    }

    public function getSize()
    {
        return filesize($this->path);
    }

    public function getType()
    {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);

        return finfo_file($finfo, $this->path);
    }

    public function getError()
    {
        return 0;
    }

    /**
     * @inheritDoc
     */
    public function isUploadedFile()
    {
        return false;
    }
}