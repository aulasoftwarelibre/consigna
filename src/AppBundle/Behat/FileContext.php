<?php

/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 11/01/15
 * Time: 19:14.
 */

namespace AppBundle\Behat;

use Component\File\Model\File;
use Component\Folder\Model\Folder;
use Behat\Gherkin\Node\TableNode;

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
            $folder = $this->getEntityManager()->getRepository('AppBundle:Folder')->findOneByName($hash['folder']);
            $tag = $this->getEntityManager()->getRepository('AppBundle:Tag')->findOneByName($hash['tags']);
            $file->setName($hash['filename']);
            $file->setPlainPassword('secret');
            if ($user) {
                $file->setOwner($user);
            }
            $file->setFolder($folder);
            $file->setCreatedAt(new \DateTime('now'));
            $file->setSize(100);
            $file->setMimeType('pdf');
            $file->setFile('test.pdf');
            $file->setPath($this->kernel->getRootDir().'/../features/files/test.pdf');
            $file->setScanStatus(File::SCAN_STATUS_OK);
            if ($userWithAccess) {
                $file->addSharedWith($userWithAccess);
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
            $folder->setName($hash['folderName']);
            $folder->setPlainPassword('secret');

            if ($user) {
                $folder->setOwner($user);
            }

            if ($userWithAccess) {
                $folder->addSharedWith($userWithAccess);
            }

            $tags = explode(',', $hash['tags']);
            foreach ($tags as $tag) {
                $entity = $this->getEntityManager()->getRepository('AppBundle:Tag')->findOneByName(trim($tag));
                $folder->addTag($entity);
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
        /** @var Folder $folder */
        $folder = $this->getEntityManager()->getRepository('AppBundle:Folder')->findOneByName($folderName);

        if ($folder->getOwner() == $user) {
            return true;
        }

        foreach ($folder->getSharedWith() as $member) {
            if ($user == $member) {
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
        /** @var Folder $folder */
        $folder = $this->getEntityManager()->getRepository('AppBundle:Folder')->findOneByName($folderName);

        $folder->addSharedWith($user);
    }

    /**
     * @Given :username can access to :filename
     */
    public function hasAccessToFile($username, $filename)
    {
        $user = $this->getEntityManager()->getRepository('AppBundle:User')->findOneByUsername($username);
        /** @var File $file */
        $file = $this->getEntityManager()->getRepository('AppBundle:File')->findOneByName($filename);

        if ($file->getOwner() == $user) {
            return true;
        }
        foreach ($file->getSharedWith() as $member) {
            if ($user == $member) {
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
        /** @var File $file */
        $file = $this->getEntityManager()->getRepository('AppBundle:File')->findOneByName($fileName);

        $file->addSharedWith($user);
    }

    /**
     * @Then folder :folderName has file :fileName
     */
    public function folderHasFile($folderName, $fileName)
    {
        $folder = $this->getEntityManager()->getRepository('AppBundle:Folder')->findOneByName($folderName);
        /** @var Folder $file */
        $file = $this->getEntityManager()->getRepository('AppBundle:File')->findOneByName($fileName);

        return $file->getFolder() == $folder;
    }

    /**
     * @Then :username is the :folderName owner
     */
    public function isOwner($username, $folderName)
    {
        $user = $this->getEntityManager()->getRepository('AppBundle:User')->findOneByUsername($username);
        /** @var Folder $folder */
        $folder = $this->getEntityManager()->getRepository('AppBundle:Folder')->findOneByName($folderName);

        return $folder->getOwner() == $user;
    }
}
