<?php

/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 16/08/15
 * Time: 11:24.
 */

namespace AppBundle\Twig;

class TwigSizeExtension extends \Twig_Extension
{
    private $units = [
        'bytes',
        'KB',
        'MB',
        'GB',
    ];

    /**
     * Returns a list of filters to add to the existing list.
     *
     * @return array An array of filters
     */
    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('size', array($this, 'size')),
        ];
    }

    public function size($bytes)
    {
        foreach ($this->units as $unit) {
            if ($bytes < 1024) {
                return sprintf('%d %s', $bytes, $unit);
            }
            $bytes /= 1024;
        }

        return sprintf('%.2f TB', $bytes);
    }
}
