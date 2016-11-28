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

namespace Component\Organization\Model;

use AppBundle\Model\UserInterface;
use Component\Organization\Model\Interfaces\OrganizationInterface;
use Component\Core\Model\Traits\ToggleableTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Organization.
 *
 * @ORM\Entity(repositoryClass="Component\Organization\Repository\OrganizationRepository")
 * @ORM\Table(name="organization")
 */
class Organization implements OrganizationInterface
{
    use ToggleableTrait;

    /**
     * @var int|null
     *
     * @ORM\Column(type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, unique=true)
     */
    protected $code;

    /**
     * @var ArrayCollection
     * @ORM\OneToMany(targetEntity="AppBundle\Model\UserInterface", mappedBy="organization", cascade={"persist", "remove"})
     */
    protected $users;

    /**
     * Organization constructor.
     */
    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    /**
     * To string.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getName();
    }

    /**
     * @return int|null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return Organization
     */
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param string $code
     *
     * @return Organization
     */
    public function setCode(string $code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * @param UserInterface $user
     *
     * @return $this
     */
    public function addUser(UserInterface $user)
    {
        $user->setOrganization($this);
        $this->users->add($user);

        return $this;
    }

    /**
     * @param UserInterface $user
     *
     * @return $this
     */
    public function removeUser(UserInterface $user)
    {
        $user->setOrganization(null);
        $this->users->removeElement($user);

        return $this;
    }
}
