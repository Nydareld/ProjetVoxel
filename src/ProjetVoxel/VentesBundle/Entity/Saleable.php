<?php

namespace ProjetVoxel\VentesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
abstract class Saleable extends OpperationObject
{
    /**
     * @var integer
     *
     * @ORM\Column(name="unit_price", type="integer")
     */
    protected $unitPrice;

    /**
     * @var integer
     *
     * @ORM\Column(name="quantity", type="integer")
     */
    protected $quantity = 1;


    public function getType(){
        return "Saleable";
    }

    public function getUnitPrice(){
		return $this->unitPrice;
	}

	public function setUnitPrice($unitPrice){
		$this->unitPrice = $unitPrice;
	}

	public function getQuantity(){
		return $this->quantity;
	}

	public function setQuantity($quantity){
		$this->quantity = $quantity;
	}

    public function getTotalPrice(){
        return $this->unitPrice*$this->quantity;
    }

}
