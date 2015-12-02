<?php

namespace ProjetVoxel\VentesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class ItemModel {
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var boolean
     *
     * @ORM\Column(name="senative", type="boolean")
     */
    protected $spaceEngineerNative = true; //Si l'objet est de SE ou a été créé

    /**
     * @ORM\OneToMany(targetEntity="CatalogueItem", mappedBy="item")
     */
    protected $soldBy;


    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

    public function getName(){
        return $this->name;
    }

    public function setName($name){
        $this->name = $name;
    }

    public function isSpaceEngineerNative(){
        return $this->spaceEngineerNative;
    }

    public function setSpaceEngineerNative($spaceEngineerNative){
        $this->spaceEngineerNative = $spaceEngineerNative;
    }

    public function getSoldBy(){
        return $this->soldBy;
    }

    public function setSoldBy($soldBy){
        $this->soldBy = $soldBy;
    }
}
