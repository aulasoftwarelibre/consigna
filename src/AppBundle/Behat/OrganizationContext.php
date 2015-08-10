<?php
/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 10/08/15
 * Time: 21:06
 */

namespace AppBundle\Behat;


use AppBundle\Entity\Organization;
use Behat\Gherkin\Node\TableNode;
use Sensio\Bundle\FrameworkExtraBundle\Security\ExpressionLanguage;

class OrganizationContext extends DefaultContext
{
    /**
     * @Given existing organizations:
     */
    public function createList(TableNode $tableNode)
    {
        $eval = new ExpressionLanguage();

        $em = $this->getEntityManager();
        foreach ($tableNode as $hash) {
            $organization = new Organization();
            $organization->setName($hash['name']);
            $organization->setCode($hash['code']);
            $organization->setIsEnabled($eval->evaluate($hash['enabled']));

            $em->persist($organization);
        }
        $em->flush();
    }
}