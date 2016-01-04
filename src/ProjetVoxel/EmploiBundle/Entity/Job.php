<?php

namespace ProjetVoxel\EmploiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Job
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Job
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
     * @var string
     *
     * @ORM\Column(name="Description", type="text")
     */
    private $description;

    /**
     * @var integer
     *
     * @ORM\Column(name="Wages", type="integer")
     */
    private $wages;

    /**
     * @var integer
     *
     * @ORM\Column(name="RoomLeft", type="integer")
     */
    private $jobLeft;

    /**
     * @var integer
     *
     * @ORM\Column(name="DayOff", type="integer")
     */
    private $dayOff;

    /**
     * @ORM\OneToMany(targetEntity="ProjetVoxel\UserBundle\Entity\User", mappedBy="job")
     */
    private $employee;

    /**
     * @ORM\ManyToOne(targetEntity="Company", inversedBy="listOfJob")
     */

    private $Company;


    /**
     * @ORM\OneToMany(targetEntity="ProjetVoxel\UserBundle\Entity\User", mappedBy="jobApply")
     */

    private $appliant;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Job
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
     * Set description
     *
     * @param string $description
     *
     * @return Job
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set wages
     *
     * @param integer $wages
     *
     * @return Job
     */
    public function setWages($wages)
    {
        $this->wages = $wages;

        return $this;
    }

    /**
     * Get wages
     *
     * @return integer
     */
    public function getWages()
    {
        return $this->wages;
    }

    /**
     * Set dayOff
     *
     * @param integer $dayOff
     *
     * @return Job
     */
    public function setDayOff($dayOff)
    {
        $this->dayOff = $dayOff;

        return $this;
    }

    /**
     * Get dayOff
     *
     * @return integer
     */
    public function getDayOff()
    {
        return $this->dayOff;
    }

    public function getCompany()
    {
        return $this->Company;
    }

    public function setCompany($Company)
    {
        $this->Company = $Company;
    }

    public function getAppliant()
    {
        return $this->appliant;
    }

    public function setAppliant($appliant)
    {
        $this->appliant = $appliant;
    }

    public function getJobLeft()
    {
        return $this->jobLeft;
    }

    public function setJobLeft($jobLeft)
    {
        $this->jobLeft = $jobLeft;
    }

    public function getEmployee()
    {
        return $this->employee;
    }

    public function setEmployee($employee)
    {
        $this->employee = $employee;
    }

    public function getAppliantById($appliantId)
    {

        foreach ($this->getappliant() as $type) {
            if ($type->getid() == $appliantId) {
                return $type;
            }
        }
        return null;
    }
}

