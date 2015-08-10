<?php
/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 09/08/15
 * Time: 22:28
 */

namespace AppBundle\Twig;


use Symfony\Component\Translation\TranslatorInterface;

class TranslatorExtension extends \Twig_Extension
{
    /**
     * @var TranslatorInterface
     */
    private $translator;

    /**
     * Constructor
     *
     * @param TranslatorInterface $translator
     */
    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    /**
     * Returns a list of functions to add to the existing list.
     *
     * @return array An array of functions
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('_', [$this, 'trans']),
            new \Twig_SimpleFunction('__', [$this, 'transChoice']),
        ];
    }

    /**
     * @see TranslatorInterface::trans()
     */
    public function trans($id, $parameters = [], $domain = null, $locale = null)
    {
        return $this->translator->trans($id, $parameters, $domain, $locale);
    }

    /**
     * @see TranslatorInterface::transChoice()
     */
    public function transChoice($id, $number, $parameters = [], $domain = null, $locale = null)
    {
        $parameters['%count%'] = $number;
        return $this->translator->transChoice($id, $number, $parameters, $domain, $locale);
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'sgomez_translation';
    }

}