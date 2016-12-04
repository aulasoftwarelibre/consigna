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

namespace MovedBundle\Twig;

use AppBundle\Repository\FileRepository;

class TwigSizeExtension extends \Twig_Extension
{
    /**
     * @var FileRepository
     */
    private $fileRepository;

    public function __construct(FileRepository $fileRepository)
    {
        $this->fileRepository = $fileRepository;
    }

    private $units = [
        'bytes',
        'KB',
        'MB',
        'GB',
    ];

    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('consigna_statistics', [$this, 'getStatistics']),
        ];
    }

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

    public function getStatistics()
    {
        return $this->fileRepository->sizeAndNumOfFiles();
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
