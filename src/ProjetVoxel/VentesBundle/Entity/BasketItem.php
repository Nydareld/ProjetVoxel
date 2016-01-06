<?php

namespace ProjetVoxel\VentesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class BasketItem {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="quantity", type="integer")
     */
    protected $quantity = 1;

    /**
     * @ORM\ManyToOne(targetEntity="ProjetVoxel\EconomyBundle\Entity\BankId", inversedBy="basket")
     */
    protected $bankId;

    /**
     * @ORM\ManyToOne(targetEntity="ProjetVoxel\VentesBundle\Entity\CatalogueItem", inversedBy="inBasket")
     */
    protected $catalogueItem;

    public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
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

	public function getCatalogueItem(){
		return $this->catalogueItem;
	}

	public function setCatalogueItem($catalogueItem){
		$this->catalogueItem = $catalogueItem;
	}
    
}
