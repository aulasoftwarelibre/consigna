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
