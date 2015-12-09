<?php

namespace ProjetVoxel\VentesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class CatalogueItem {

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
     * @var integer
     *
     * @ORM\Column(name="unit_price", type="integer")
     */
    protected $unitPrice;

    /**
     * @var string
     *
     * @ORM\Column(name="unit", type="string", length=255)
     */
    protected $unit;

    /**
     * @var integer
     *
     * @ORM\Column(name="quantity", type="integer")
     */
    protected $quantity = 1;

    /**
     * @ORM\ManyToOne(targetEntity="ProjetVoxel\EconomyBundle\Entity\BankId", inversedBy="catalogue")
     */
    protected $bankId;

    /**
     * @var boolean
     *
     * @ORM\Column(name="enable", type="boolean")
     */
    protected $enable = true;

    /**
     * @ORM\Column(name="type", type="string", length=255)
     */
    protected $type; // Peut etre un objet ou un service (Objet peut etre un ojet de SE ou un CustomObject comme un vaisseau complet )

    /**
     * @ORM\ManyToOne(targetEntity="ItemModel", inversedBy="soldBy")
     */
    protected $item;

    /**
     * @ORM\ManyToOne(targetEntity="ServiceModel", inversedBy="soldBy")
     */
    protected $service;

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

    public function getUnitPrice(){
        return $this->unitPrice;
    }

    public function setUnitPrice($unitPrice){
        $this->unitPrice = $unitPrice;
    }

    public function getUnit(){
        return $this->unit;
    }

    public function setUnit($unit){
        $this->unit = $unit;
    }

    public function getQuantity(){
        return $this->quantity;
    }

    public function setQuantity($quantity){
        $this->quantity = $quantity;
    }

    public function getBankId(){
        return $this->bankId;
    }

    public function setBankId($bankId){
        $this->bankId = $bankId;
    }

    public function getEnable(){
        return $this->enable;
    }

    public function setEnable($enable){
        $this->enable = $enable;
    }

    public function getType(){
        return $this->type;
    }

    public function setType($type){
        $this->type = $type;
    }

    public function getItem(){
        return $this->item;
    }

    public function setItem($item){
        $this->item = $item;
    }

    public function getService(){
        return $this->service;
    }

    public function setService($service){
        $this->service = $service;
    }

}
