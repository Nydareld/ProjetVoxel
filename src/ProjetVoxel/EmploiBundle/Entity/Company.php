<?php

namespace ProjetVoxel\EmploiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Company
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Company
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
     * @ORM\Column(name="CompanyName", type="string", length=255)
     */
    private $companyName;

    /**
     * @var string
     *
     * @ORM\Column(name="Activity", type="string", length=255)
     */

    private $activity;

    /**
     * @ORM\ManyToOne(targetEntity="ProjetVoxel\UserBundle\Entity\User", inversedBy="CreatedCompany")
     */

    private $creator;

    /**
     * @ORM\OneToMany(targetEntity="ProjetVoxel\UserBundle\Entity\User", mappedBy="managedCompany")
     */
    private $manager = array();

    /**
     * @ORM\OneToMany(targetEntity="ProjetVoxel\UserBundle\Entity\User", mappedBy="ownedCompany")
     */
    private $owner = array();

    /**
     * @var string
     *
     * @ORM\Column(name="Description", type="text")
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="CreationDate", type="date")
     */
    private $creationDate;

    /**
     * @ORM\OneToOne(targetEntity="ProjetVoxel\EconomyBundle\Entity\bankId", mappedBy="company")
     */
    private $bankId;

     /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
   protected $path;

   /**
    * @Assert\File(maxSize="1000000")
    */
   private $file;


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
     * Set companyName
     *
     * @param string $companyName
     *
     * @return Company
     */
    public function setCompanyName($companyName)
    {
        $this->companyName = $companyName;

        return $this;
    }

    /**
     * Get companyName
     *
     * @return string
     */
    public function getCompanyName()
    {
        return $this->companyName;
    }

    /**
     * Set activity
     *
     * @param string $activity
     *
     * @return Company
     */
    public function setActivity($activity)
    {
        $this->activity = $activity;

        return $this;
    }

    /**
     * Get activity
     *
     * @return string
     */
    public function getActivity()
    {
        return $this->activity;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Company
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
     * Set creationDate
     *
     * @param \DateTime $creationDate
     *
     * @return Company
     */
    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;

        return $this;
    }

    /**
     * Get creationDate
     *
     * @return \DateTime
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    public function getCreator(){
        return $this->creator;
    }

    public function setCreator($creator){
        $this->creator = $creator;
    }

    public function getManager(){
        return $this->manager;
    }

    public function setManager($manager){
        $this->manager = $manager;
    }

    public function getOwner(){
        return $this->owner;
    }

    public function setOwner($owner){
        $this->owner = $owner;
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
        return 'uploads/entreprises';
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
        $fileName = $this->companyName.'.'.$extension;

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
