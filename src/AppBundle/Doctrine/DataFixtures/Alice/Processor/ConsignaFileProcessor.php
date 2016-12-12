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


namespace AppBundle\Doctrine\DataFixtures\Alice\Processor;


use AppBundle\Doctrine\Extensions\Uploader\FileInfo\DataFixtureFileInfo;
use AppBundle\Entity\Interfaces\FileInterface;
use Gedmo\Uploadable\UploadableListener;
use Nelmio\Alice\ProcessorInterface;

class ConsignaFileProcessor implements ProcessorInterface
{
    /**
     * @var UploadableListener
     */
    private $uploadableListener;

    /**
     * @inheritDoc
     */
    public function __construct(UploadableListener $uploadableListener)
    {
        $this->uploadableListener = $uploadableListener;
    }

    /**
     * @inheritDoc
     */
    public function preProcess($object)
    {
        if (false === $object instanceof FileInterface) {
            return;
        }

        $fileinfo = __DIR__ . '/../../../../Resources/fixtures/files/test.pdf';

        $this
            ->uploadableListener
            ->addEntityFileInfo($object, new DataFixtureFileInfo($fileinfo));
    }

    /**
     * @inheritDoc
     */
    public function postProcess($object)
    {
    }
}