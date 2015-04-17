<?php
/**
 * Created by PhpStorm.
 * User: juanan
 * Date: 16/04/15
 * Time: 18:38
 */

namespace AppBundle;

use Monolog\Logger;

final class FileEvents
{
    /**
     * This event occurs when a file is uploaded
     *
     * The event listener receives an
     * AppBundle\Event\FileEvent instance
     *
     * @var Logger
     */

    const SUBMITTED = 'consigna.file.submitted';
}