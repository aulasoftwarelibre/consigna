<?php

/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 09/08/15
 * Time: 21:05.
 */

namespace MovedBundle\Uploader\Namer;

use Oneup\UploaderBundle\Uploader\File\FileInterface;
use Oneup\UploaderBundle\Uploader\Naming\NamerInterface;

class RealNamer implements NamerInterface
{
    /**
     * Name a given file and return the name.
     *
     * @param FileInterface $file
     *
     * @return string
     */
    public function name(FileInterface $file)
    {
        return $file->getClientOriginalName();
    }
}
