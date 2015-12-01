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

}
