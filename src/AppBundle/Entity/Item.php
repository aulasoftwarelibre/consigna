<?php
/**
 * This file is part of the Consigna project.
 *
 * (c) Juan Antonio Martínez <juanto1990@gmail.com>
 * (c) Sergio Gómez <sergio@uco.es>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


namespace AppBundle\Entity;


use AppBundle\Entity\Interfaces\FolderInterface;
use AppBundle\Entity\Interfaces\ItemInterface;
use AppBundle\Model\Traits\ExpirableTrait;
use AppBundle\Model\Traits\OwneableTrait;
use AppBundle\Model\Traits\ProtectableTrait;
use AppBundle\Model\Traits\ShareableTrait;
use AppBundle\Model\Traits\TimestampableTrait;
use AppBundle\Model\Traits\TraceableTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class AbstractItem
 * @package AppBundle\Entity\Abstracts
 *
 * @ORM\Entity()
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({"file" = "AppBundle/Entity/File", "folder" = "AppBundle/Entity/Folder"})
 */
abstract class Item implements ItemInterface
{
    use ExpirableTrait;

    use OwneableTrait;

    use ProtectableTrait;

    use ShareableTrait;

    use TimestampableTrait;

    use TraceableTrait;

    /**
     * @var integer|null
     */
    protected $id;

    /**
     * @var FolderInterface
     */
    protected $folder;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $tag;

    /**
     * @var string
     */
    protected $slug;

    /**
     * @inheritDoc
     */
    public function __construct()
    {
        $randomStringGenerator = function ($length) {
            return base64_encode(bin2hex(openssl_random_pseudo_bytes($length)));
        };

        $this->salt = $randomStringGenerator(16);
        $this->sharedCode = $randomStringGenerator(16);
        $this->sharedWithUsers = new ArrayCollection();
    }

    /**
     * Get instance name.
     *
     * @return string
     */
    function __toString()
    {
        return $this->getName();
    }

    /**
     * Get instance id.
     *
     * @return int|null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return FolderInterface
     */
    public function getFolder()
    {
        return $this->folder;
    }

    /**
     * @param FolderInterface $folder
     *
     * @return $this
     */
    public function setFolder(FolderInterface $folder = null)
    {
        $this->folder = $folder;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @inheritDoc
     */
    public function setName(string $name): ItemInterface
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getSlug(): ?string
    {
        return $this->slug;
    }

    /**
     * @inheritDoc
     */
    public function setSlug(string $slug): ItemInterface
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getTag(): ?string
    {
        return $this->tag;
    }

    /**
     * @param string|null $tag
     *
     * @return $this
     */
    public function setTag(?string $tag)
    {
        $this->tag = $tag;

        return $this;
    }
}