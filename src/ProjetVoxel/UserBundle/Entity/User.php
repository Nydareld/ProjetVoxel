<?php

namespace ProjetVoxel\UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table()
 * @ORM\Entity
 */
 class User extends BaseUser
 {
     /**
      * @var integer
      *
      * @ORM\Column(name="id", type="integer")
      * @ORM\Id
      * @ORM\GeneratedValue(strategy="AUTO")
      */
     protected $id;

     /**
      * @ORM\OneToMany(targetEntity="ProjetVoxel\EmploiBundle\Entity\Company", mappedBy="creator")
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
