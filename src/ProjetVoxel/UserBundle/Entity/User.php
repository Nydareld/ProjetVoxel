<?php

namespace ProjetVoxel\UserBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;
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
      * @ORM\ManyToMany(targetEntity="ProjetVoxel\UserBundle\Entity\Group")
      * @ORM\JoinTable(name="user_user_group",
      *      joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
      *      inverseJoinColumns={@ORM\JoinColumn(name="group_id", referencedColumnName="id")}
      * )
      */
     protected $groups;

     /**
      * @ORM\OneToOne(targetEntity="ProjetVoxel\EconomyBundle\Entity\BankId", mappedBy="user")
      */
     private $bankId;

     /**
      * @ORM\OneToMany(targetEntity="ProjetVoxel\EmploiBundle\Entity\Company", mappedBy="creator")
      */
     private $CreatedCompany;

     /**
      * @ORM\ManyToOne(targetEntity="ProjetVoxel\EmploiBundle\Entity\Company", inversedBy="manager")
      */
     private $managedCompany;

     /**
      * @ORM\ManyToOne(targetEntity="ProjetVoxel\EmploiBundle\Entity\Company", inversedBy="owner")
      * */
     private $ownedCompany;

     /**
      * @ORM\Column(type="string", length=255, nullable=true)
      */

     protected $path;

    /**
     * @Assert\File(maxSize="1000000")
     */
     private $file;

     /**
      * @ORM\ManyToOne(targetEntity="ProjetVoxel\EmploiBundle\Entity\Job", inversedBy="employee")
      */
     private $job;

     /**
      * @ORM\ManyToOne(targetEntity="ProjetVoxel\EmploiBundle\Entity\Job", inversedBy="appliant")
      */
     private $jobApply;

     /**
      * @ORM\OneToMany(targetEntity="ProjetVoxel\AdministrativeBundle\Entity\Ship", mappedBy="owner")
      */
     private $ownedShip;


     /**
      * @ORM\OneToMany(targetEntity="Notification",mappedBy="user")
      */

     private $notif;


    /**
     * Get id
     *
     * @return integer
     */



     public function getOwnedShip(){
         return $this->ownedShip;
     }

     public function setOwnedShip($ownedShip){
         $this->ownedShip = $ownedShip;
     }

     public function getJob(){
         return $this->job;
     }

     public function setJob($job){
         $this->job = $job;
     }

     public function getNotif(){
         return $this->notif;
     }

     public function setNotif($notif){
         $this->notif = $notif;
     }

     public function getJobApply(){
         return $this->jobApply;
     }

     public function setJobApply($jobApply){
         $this->jobApply = $jobApply;
     }

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

    public function getManagedCompany(){
        return $this->managedCompany;
    }

    public function setManagedCompany($managedCompany){
        $this->managedCompany = $managedCompany;
    }

    public function getOwnedCompany(){
        return $this->ownedCompany;
    }

    public function setOwnedCompany($ownedCompany){
        $this->ownedCompany = $ownedCompany;
    }

     public function getBankId(){
         return $this->bankId;
     }

     public function setBankId($bankId){
         $this->bankId = $bankId;
     }

    public function getPath(){
        return $this->path;
    }

    public function setPath($path){
        $this->path = $path;
    }

    public function getAbsolutePath()
    {
        return null === $this->path
            ? null
            : $this->getUploadRootDir().'/'.$this->path;
    }

    public function getWebPath()
    {
        return null === $this->path
            ? null
            : '/'.$this->getUploadDir().'/'.$this->path;
    }
    protected function getUploadRootDir()
    {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    protected function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'uploads/avatars';
    }

    /**
     * Sets file.
     *
     * @param UploadedFile $file
     */
    public function setFile(UploadedFile $file = null)
    {
        $this->file = $file;
    }

    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFile()
    {
        return $this->file;
    }

    public function upload()
    {
        // the file property can be empty if the field is not required
        if (null === $this->getFile()) {
            return;
        }

        // use the original file name here but you should
        // sanitize it at least to avoid any security issues

        // move takes the target directory and then the
        // target filename to move to

        $extension = $this->file->guessExtension();
        $fileName = $this->username.'.'.$extension;

        $this->getFile()->move(
            $this->getUploadRootDir(),
            $fileName
        );

        // set the path property to the filename where you've saved the file
        $this->path = $fileName;

        // clean up the file property as you won't need it anymore
        $this->file = null;
    }



 }
