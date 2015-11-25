<?php

namespace ProjetVoxel\EconomyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * bankId
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class bankId
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
     * @ORM\OneToOne(targetEntity="ProjetVoxel\UserBundle\Entity\User", inversedBy="bankId")
     */
    private $user;

    /**
     * @ORM\OneToOne(targetEntity="ProjetVoxel\EmploiBundle\Entity\Company", inversedBy="bankId")
     */
    private $company;


    /**
     * @ORM\OneToMany(targetEntity="ProjetVoxel\EconomyBundle\Entity\bankAccount", mappedBy="owner")
     */
    private $bankAccount;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    public function getUser(){
        return $this->user;
    }

    public function setUser($user){
        $this->user = $user;
    }

    public function getCompany(){
        return $this->company;
    }

    public function setCompany($company){
        $this->company = $company;
    }

    public function getBankAccount(){
        return $this->bankAccount;
    }

    public function setBankAccount($bankAccount){
        $this->bankAccount = $bankAccount;
    }
}

