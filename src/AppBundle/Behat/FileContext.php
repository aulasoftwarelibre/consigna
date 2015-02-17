<?php
/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 11/01/15
 * Time: 19:14
 */

namespace AppBundle\Behat;


use AppBundle\Entity\File;
use AppBundle\Entity\Folder;
use Behat\Gherkin\Node\TableNode;

class FileContext extends CoreContext
{
    /**
     * @Given existing files:
     */
    public function createFileList (TableNode $tableNode)
    {
        $em = $this->getEntityManager();
        foreach ($tableNode as $hash){

            $file = new File();

            $user=$this->getEntityManager()->getRepository('AppBundle:User')->findOneByUsername($hash['username']);
            $file->setFilename($hash['filename']);
            $file->setUploadDate(new \DateTime($hash['uploadDate']));
            $file->setPassword('secret');
            $file->setUser($user);


            $em-> persist($file);
        }
        $em->flush();
    }

    /**
     * @Given existing folders:
     */
    public function createFolderList(TableNode $tableNode)
    {
        $em = $this->getEntityManager();
        foreach ($tableNode as $hash) {

            $folder = new Folder();

            $user=$this->getEntityManager()->getRepository('AppBundle:User')->findOneByUsername($hash['username']);
            $folder->setFolderName($hash['folderName']);
            $folder->setDescription($hash['description']);
            $folder->setUploadDate(new \DateTime($hash['uploadDate']));
            $folder->setUser($user);

            $em->persist($folder);
        }
        $em->flush();
    }

    /**
     * @Then /^I should see (\d+) elements/
     */
    public function iShouldSeeFiles( $numElements )
    {
        $this->assertSession()->elementsCount('css', '.info', $numElements);
    }
}