<?php

namespace ProjetVoxel\EconomyBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use ProjetVoxel\UserBundle\Entity\User;

/**
 * bankId
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class BankId
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
     * @ORM\OneToMany(targetEntity="ProjetVoxel\EconomyBundle\Entity\BankAccount", mappedBy="owner")
     */
    private $bankAccount;

    /**
     * @ORM\OneToMany(targetEntity="ProjetVoxel\VentesBundle\Entity\CatalogueItem", mappedBy="bankId")
     */
    private $catalogue;

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

    public function getCatalogue(){
        return $this->catalogue;
    }

    public function setCatalogue($catalogue){
        $this->catalogue = $catalogue;
    }

    public function userHasWright(User $theUser){
        if($theUser == $this->getUser()){
            return true;
        }elseif(null !== $this->getCompany()){
            if( in_array($theUser, $this->getCompany()->getManager()->getValues()) ){
                return true;
            }
        }else{
            return false;
        }
    }

}
