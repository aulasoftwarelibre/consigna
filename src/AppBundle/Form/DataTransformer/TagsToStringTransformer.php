<?php

namespace AppBundle\Form\DataTransformer;

use AppBundle\Entity\Tag;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Doctrine\Common\Persistence\ObjectManager;

class TagsToStringTransformer implements DataTransformerInterface
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
    * @param  ArrayCollection $tags
    * @return string
    */
    public function transform($tags)
    {
        return implode(",", $tags->toArray());
    }

    /**
    * Transforms a string (number) to an object (issue).
    *
    * @param  string $string
    *
    * @return \Doctrine\Common\Collections\ArrayCollection|null
    *
    * @throws TransformationFailedException if object (tagName) is not found.
    */
    public function reverseTransform($string)
    {
        $tags = explode(',', $string);
        $arrayCollection=new ArrayCollection();
        foreach ($tags as $tag) {
            $tag = trim($tag);
            if (!($newTag = $this->om->getRepository('AppBundle:Tag')->findOneBy(array('tagName'=>$tag)))) {
                $newTag = new Tag();
                $newTag->setTagName($tag);
                $this->om->persist($newTag);
            }
            $arrayCollection->add($newTag);
        }
        $this->om->flush();

        return $arrayCollection;
    }
}