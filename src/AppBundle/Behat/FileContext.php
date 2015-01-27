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
            $file->setFilename($hash['filename']);
            $file->setDescription($hash['description']);
            $file->setUploadDate(new \DateTime($hash['uploadDate']));
            $file->setPassword($hash['password']);
            $file->setOwner($hash['owner']);

            $em-> persist($file);
        }
        $em->flush();
    }
}