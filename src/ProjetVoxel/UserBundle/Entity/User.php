<?php

namespace ProjetVoxel\UserBundle\Entity;

use Symfony\Component\Security\Core\User\UserInterface;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * User
 */
class User extends BaseUser
{
    /**
     * @var integer
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="ProjetVoxel\UserBundle\Entity\Company", mappedBy="creator")
     */
    private $CreatedCompany;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }


    public function getCreatedCompany(){
        return $this->CreatedCompany;
    }

    public function setCreatedCompany($CreatedCompany){
        $this->CreatedCompany = $CreatedCompany;
    }
}
