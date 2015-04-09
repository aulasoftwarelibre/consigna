<?php

namespace Acme\TaskBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Tag;

class TagToStringTransformer implements DataTransformerInterface
{
    /**
    * @var ObjectManager
    */
    private $om;

    /**
    * @param ObjectManager $om
    */
    public function __construct(ObjectManager $om)
    {
        $this->om = $om;
    }

    /**
    * Transforms an object (issue) to a string (number).
    *
    * @param  Tag|null $tag
    * @return string
    */
    public function transform($tag)
    {
        if (null === $tag) {
            return " ";
        }

        return $tag->getTagName();
    }

    /**
    * Transforms a string (number) to an object (issue).
    *
    * @param  string $tagName
    *
    * @return Tag|null
    *
    * @throws TransformationFailedException if object (tagName) is not found.
    */
    public function reverseTransform($tagName)
    {
        if (!$tagName) {
            return null;
        }

        $issue = $this->om
            ->getRepository('AppBundle:Tag')
            ->findOneBy(array('tagName' => $tagName));

        if (null === $tagName) {
            throw new TransformationFailedException(sprintf(
            'A tag with tagName "%s" does not exist!',
            $tagName
            ));
        }
            return $issue;
    }
}