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

namespace Bundle\CoreBundle\Model\Interfaces;

interface UploadableInterface
{
    public function getFile();

    public function setFile($file);

    public function getMimeType();

    public function setMimeType(string $file);

    public function getPath();

    public function setPath(string $file);

    public function getSize();

    public function setSize(int $size);
}
