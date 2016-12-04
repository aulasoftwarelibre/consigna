<?php

namespace Bundle\TagBundle\Form\DataTransformer;

use Bundle\TagBundle\Services\TagManager;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Form\DataTransformerInterface;

class TagsToStringTransformer implements DataTransformerInterface
{
    /**
     * @var TagManager
     */
    private $manager;

    /**
     * Constructor.
     *
     * @param TagManager $manager
     */
    public function __construct(TagManager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * Transforms an ArrayCollection to a string.
     *
     * @param $tags ArrayCollection|null
     *
     * @return string
     */
    public function transform($tags)
    {
        if (null === $tags) {
            return '';
        }

        return implode(', ', $tags->toArray());
    }

    /**
     * Transforms a string to an ArrayCollection.
     *
     * @param string $value
     *
     * @return array
     */
    public function reverseTransform($value)
    {
        if (null === $value) {
            return [];
        }

        $tokens = preg_split('/(\s*,\s*)+/', $value, -1, PREG_SPLIT_NO_EMPTY);

        return $this->manager->extractTagsFromTokens($tokens);
    }
}
