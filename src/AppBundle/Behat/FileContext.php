<?php

/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 11/01/15
 * Time: 19:14.
 */

namespace AppBundle\Behat;

use AppBundle\Entity\File;
use AppBundle\Entity\Folder;
use AppBundle\Entity\User;
use Behat\Gherkin\Node\TableNode;
use Sylius\Bundle\ResourceBundle\Behat\DefaultContext;

class FileContext extends DefaultContext
{
    /**
     * @Given existing files:
     */
    public function createFileList(TableNode $tableNode)
    {
        $em = $this->getEntityManager();
        foreach ($tableNode as $hash) {
            $file = new File();

            $user = $this->getEntityManager()->getRepository('AppBundle:User')->findOneByUsername($hash['username']);
            $userWithAccess = $this->getEntityManager()->getRepository('AppBundle:User')->findOneByUsername($hash['userWithAccess']);
            $folder = $this->getEntityManager()->getRepository('AppBundle:Folder')->findOneByFolderName($hash['folder']);
            $tag = $this->getEntityManager()->getRepository('AppBundle:Tag')->findOneByTagName($hash['tags']);
            $file->setFilename($hash['filename']);
            $file->setPlainPassword('secret');
            $file->setUser($user);
            $file->setFolder($folder);
            $file->setUploadDate(new \DateTime('now'));
            $file->setSize(100);
            $file->setMimeType('pdf');
            $file->setFile('test.pdf');
            $file->setPath('/home/juanan/consigna/app/../features/files/test.pdf');
            $file->setIpAddress('127.0.0.1');
            $file->setScanStatus(File::SCAN_STATUS_OK);
            if ($userWithAccess) {
                $file->addUsersWithAccess($userWithAccess);
            }
            if ($tag) {
                $file->addTag($tag);
            }
            $em->persist($file);
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

            $user = $this->getEntityManager()->getRepository('AppBundle:User')->findOneByUsername($hash['username']);
            $userWithAccess = $this->getEntityManager()->getRepository('AppBundle:User')->findOneByUsername($hash['userWithAccess']);
            $tag = $this->getEntityManager()->getRepository('AppBundle:Tag')->findOneByTagName($hash['tags']);
            $folder->setFolderName($hash['folderName']);
            $folder->setPlainPassword('secret');
            $folder->setUploadDate(new \DateTime('now'));
            $folder->setUser($user);
            if ($userWithAccess) {
                $folder->addUsersWithAccess($userWithAccess);
            }
            if ($tag) {
                $folder->addTag($tag);
            }

            $em->persist($folder);
        }
        $em->flush();
    }

    /**
     * @Then /^I should see (\d+) elements/
     */
    public function iShouldSeeFiles($numElements)
    {
        $this->assertSession()->elementsCount('css', '.info', $numElements);
    }

    /**
     * @Given :username has access to :folderName
     */
    public function hasAccess($username, $folderName)
    {
        $user = $this->getEntityManager()->getRepository('AppBundle:User')->findOneByUsername($username);
        $folder = $this->getEntityManager()->getRepository('AppBundle:Folder')->findOneByFolderName($folderName);

        if ($folder->getUser() == $user) {
            return true;
        }
        foreach ($folder->getUsersWithAccess() as $uWithAccess) {
            if ($user == $uWithAccess) {
                return true;
            }
        }

        return false;
    }

    /**
     * @Then access is granted to :username in :folderName
     */
    public function grantAccessToFolder($username, $folderName)
    {
        $user = $this->getEntityManager()->getRepository('AppBundle:User')->findOneByUsername($username);
        $folder = $this->getEntityManager()->getRepository('AppBundle:Folder')->findOneByFolderName($folderName);

        $folder->addUsersWithAccess($user);
    }

    /**
     * @Given :username can access to :filename
     */
    public function hasAccessToFile($username, $filename)
    {
        $user = $this->getEntityManager()->getRepository('AppBundle:User')->findOneByUsername($username);
        $file = $this->getEntityManager()->getRepository('AppBundle:File')->findOneByFilename($filename);

        if ($file->getUser() == $user) {
            return true;
        }
        foreach ($file->getUsersWithAccess() as $uWithAccess) {
            if ($user == $uWithAccess) {
                return true;
            }
        }

        return false;
    }

    /**
     * @Then access is granted to :username in file :fileName
     */
    public function grantAccessToFile($username, $fileName)
    {
        $user = $this->getEntityManager()->getRepository('AppBundle:User')->findOneByUsername($username);
        $file = $this->getEntityManager()->getRepository('AppBundle:File')->findOneByFilename($fileName);

        $file->addUsersWithAccess($user);
    }

    /**
     * @Then folder :folderName has file :fileName
     */
    public function folderHasFile($folderName, $fileName)
    {
        $folder = $this->getEntityManager()->getRepository('AppBundle:Folder')->findOneByFolderName($folderName);
        $file = $this->getEntityManager()->getRepository('AppBundle:File')->findOneByFilename($fileName);

        $file->getFolder() == $folder;
    }

    /**
     * @Then :username is the :folderName owner
     */
    public function isOwner($username, $folderName)
    {
        $folder = $this->getEntityManager()->getRepository('AppBundle:Folder')->findOneByFolderName($folderName);
        $user = $this->getEntityManager()->getRepository('AppBundle:User')->findOneByUsername($username);

        $folder->getUser() == $user;
    }
}
