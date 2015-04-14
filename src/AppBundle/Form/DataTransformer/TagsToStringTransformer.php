<?php

namespace AppBundle\Form\DataTransformer;

use AppBundle\Entity\Tag;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Form\DataTransformerInterface;
use Doctrine\Common\Persistence\ObjectManager;

class TagsToStringTransformer implements DataTransformerInterface
{
    /**
     * @var ObjectManager
     */
    private $om;

    /**
     * Constructor.
     *
     * @param ObjectManager $om
     */
    public function __construct(ObjectManager $om)
    {
        $this->om = $om;
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
     * @return ArrayCollection
     */
    public function reverseTransform($value)
    {
        $tags = new ArrayCollection();

        if (null === $value) {
            return $tags;
        }

        $tokens = preg_split('/(\s*,\s*)+/', $value, -1, PREG_SPLIT_NO_EMPTY);
        foreach ($tokens as $token) {
            if (null === ($tag = $this->om->getRepository('AppBundle:Tag')->findOneBy(array('tagName' => ($token))))) {
                $tag = new Tag();
                $tag->setTagName($token);
                $this->om->persist($tag);
            }
            $tags->add($tag);
        }
        $this->om->flush();

        return $tags;
    }
}
