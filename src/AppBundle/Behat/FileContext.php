<?php
/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 11/01/15
 * Time: 19:14
 */

namespace AppBundle\Behat;


use AppBundle\Entity\File;
use Behat\Gherkin\Node\TableNode;

class FileContext extends CoreContext
{
    /**
     * @Given existing files:
     */

    public function createList (TableNode $tableNode)
    {

        $em = $this->getEntityManager();
        foreach ($tableNode as $hash){

            $file = new File();

            $user=$this->getEntityManager()->getRepository('AppBundle:User')->findOneByUsername($hash['username']);
            $file->setFilename($hash['filename']);
            $file->setUploadDate(new \DateTime($hash['uploadDate']));
            $file->setPassword($hash['password']);
            $file->setUser($user);


            $em-> persist($file);
        }
        $em->flush();
    }
}