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


namespace AppBundle\EventListener\Annotation;


use AppBundle\Doctrine\Annotation\Filter;
use Doctrine\Common\Annotations\Reader;
use Doctrine\Common\Util\ClassUtils;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;

class FilterDriver
{
    /**
     * @var Reader
     */
    private $reader;
    /**
     * @var EntityManager
     */
    private $manager;

    /**
     * @inheritDoc
     */
    public function __construct(Reader $reader, EntityManager $manager)
    {
        $this->reader = $reader;
        $this->manager = $manager;
    }

    public function onKernelController(FilterControllerEvent $event)
    {
        if (!is_array($controller = $event->getController())) {
            return;
        }

        $classAnnotation = $this->reader->getClassAnnotation(
            new \ReflectionClass(ClassUtils::getClass($controller[0])),
            Filter::class
        );

        if ($classAnnotation instanceof Filter) {
            $this->enableFilters($classAnnotation);
        }

        $controllerReflectionObject = new \ReflectionObject($controller[0]);
        $methodAnnotation = $this->reader->getMethodAnnotation(
              $controllerReflectionObject->getMethod($controller[1]),
              Filter::class
        );

        if ($methodAnnotation instanceof Filter) {
            $this->enableFilters($methodAnnotation);
        }
    }

    protected function enableFilters(Filter $filter)
    {
        $filters = $this->manager->getFilters();

        foreach ($filter->getEnable() as $name) {
            if (!$filters->has($name)) {
                throw new \InvalidArgumentException("Filter '" . $name . "' does not exist.");
            }

            $filters->enable($name);
        }

        foreach ($filter->getDisable() as $name) {
            if (!$filters->has($name)) {
                throw new \InvalidArgumentException("Filter '" . $name . "' does not exist.");
            }

            if ($filters->isEnabled($name)) {
                $filters->disable($name);
            }
        }
    }
}