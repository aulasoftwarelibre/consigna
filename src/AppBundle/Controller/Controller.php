<?php
/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 27/4/15
 * Time: 8:43
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller as BaseController;

class Controller extends BaseController
{
    public function markEntityToUpload($file, $filename)
    {
        $this->get('stof_doctrine_extensions.uploadable.manager')
            ->markEntityToUpload($file, $filename)
        ;
    }
}