<?php

namespace AppBundle\Behat;
use AppBundle\Entity\Tag;
use Behat\Gherkin\Node\TableNode;


class TagContext extends CoreContext
{
    /**
     * @Given existing tags:
     */
    public function createTagList (TableNode $tableNode)
    {
        $em = $this->getEntityManager();
        foreach ($tableNode as $hash){

            $tag = new Tag();
            $tag->setTagName($hash['tagName']);

            $em-> persist($tag);
        }
        $em->flush();
    }
}
