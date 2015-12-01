<?php

namespace ProjetVoxel\VentesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"package" = "Package", "saleable" = "Saleable"})
 */
abstract class OpperationObject
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    public static $type;

    /**
     * @var integer
     *
     * @ORM\Column(name="total_price", type="integer")
     */
    private $totalPrice;

    /**
     * @ORM\ManyToOne(targetEntity="Package", inversedBy="content")
     */
    protected $parent;

    public function getName(){
		return $this->name;
	}

    public function getType(){
        return "Opperation";
    }

	public function setName($name){
		$this->name = $name;
	}

    public function getChilds(){
		return $this->childs;
	}

	public function setChilds($childs){
		$this->childs = $childs;
	}

    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
    }

}
