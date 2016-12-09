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

namespace AppBundle\EventListener;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class RequestLocaleListener
{
    /**
     * @var array
     */
    private $supported_languages;

    public function __construct(array $supported_languages)
    {
        $this->supported_languages = $supported_languages;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        $request = $event->getRequest();
        $defaultLocale = $request->getPreferredLanguage($this->supported_languages);

        if (!$request->hasPreviousSession()) {
            $request->setLocale($defaultLocale);

            return;
        }

        // try to see if the locale has been set as a _locale routing parameter
        if ($locale = $request->attributes->get('_locale')) {
            $request->getSession()->set('_locale', $locale);
        } else {
            // if no explicit locale has been set on this request, use one from the session
            $request->setLocale($request->getSession()->get('_locale', $defaultLocale));
        }
    }
}
