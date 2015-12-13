<?php

namespace ProjetVoxel\AdministrativeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ship
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Ship
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="Name", type="string", length=255)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="CrewSize", type="integer")
     */
    private $crewSize;

    /**
     * @var string
     *
     * @ORM\Column(name="Category", type="string", length=255)
     */
    private $category;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isLarge", type="boolean")
     */
    private $isLarge;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isWeaponed", type="boolean")
     */
    private $isWeaponed;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isLanding", type="boolean")
     */
    private $isLanding;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isToolEquiped", type="boolean")
     */
    private $isToolEquiped;

    /**
     * @var boolean
     *
     * @ORM\Column(name="jumpDrive", type="boolean")
     */
    private $jumpDrive;

    /**
     * @var boolean
     *
     * @ORM\Column(name="standardDocking", type="boolean")
     */
    private $standardDocking;

    /**
     * @ORM\ManyToOne(targetEntity="ProjetVoxel\UserBundle\Entity\User", inversedBy="ownedShip")
     */
    private $owner;

    /**
     * Get id
     *
     * @return integer
     */

    public function getOwner(){
        return $this->owner;
    }

    public function setOwner($owner){
        $this->owner = $owner;
    }

    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Ship
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set crewSize
     *
     * @param integer $crewSize
     *
     * @return Ship
     */
    public function setCrewSize($crewSize)
    {
        $this->crewSize = $crewSize;

        return $this;
    }

    /**
     * Get crewSize
     *
     * @return integer
     */
    public function getCrewSize()
    {
        return $this->crewSize;
    }

    /**
     * Set category
     *
     * @param string $category
     *
     * @return Ship
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set isLarge
     *
     * @param boolean $isLarge
     *
     * @return Ship
     */
    public function setIsLarge($isLarge)
    {
        $this->isLarge = $isLarge;

        return $this;
    }

    /**
     * Get isLarge
     *
     * @return boolean
     */
    public function getIsLarge()
    {
        return $this->isLarge;
    }

    /**
     * Set isWeaponed
     *
     * @param boolean $isWeaponed
     *
     * @return Ship
     */
    public function setIsWeaponed($isWeaponed)
    {
        $this->isWeaponed = $isWeaponed;

        return $this;
    }

    /**
     * Get isWeaponed
     *
     * @return boolean
     */
    public function getIsWeaponed()
    {
        return $this->isWeaponed;
    }

    /**
     * Set isLanding
     *
     * @param boolean $isLanding
     *
     * @return Ship
     */
    public function setIsLanding($isLanding)
    {
        $this->isLanding = $isLanding;

        return $this;
    }

    /**
     * Get isLanding
     *
     * @return boolean
     */
    public function getIsLanding()
    {
        return $this->isLanding;
    }

    /**
     * Set isToolEquiped
     *
     * @param boolean $isToolEquiped
     *
     * @return Ship
     */
    public function setIsToolEquiped($isToolEquiped)
    {
        $this->isToolEquiped = $isToolEquiped;

        return $this;
    }

    /**
     * Get isToolEquiped
     *
     * @return boolean
     */
    public function getIsToolEquiped()
    {
        return $this->isToolEquiped;
    }

    /**
     * Set jumpDrive
     *
     * @param boolean $jumpDrive
     *
     * @return Ship
     */
    public function setJumpDrive($jumpDrive)
    {
        $this->jumpDrive = $jumpDrive;

        return $this;
    }

    /**
     * Get jumpDrive
     *
     * @return boolean
     */
    public function getJumpDrive()
    {
        return $this->jumpDrive;
    }

    /**
     * Set standardDocking
     *
     * @param boolean $standardDocking
     *
     * @return Ship
     */
    public function setStandardDocking($standardDocking)
    {
        $this->standardDocking = $standardDocking;

        return $this;
    }

    /**
     * Get standardDocking
     *
     * @return boolean
     */
    public function getStandardDocking()
    {
        return $this->standardDocking;
    }
}

