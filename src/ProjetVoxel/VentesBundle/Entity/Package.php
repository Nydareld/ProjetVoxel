<?php

namespace ProjetVoxel\VentesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Company
 *
 * @ORM\Table()
 * @ORM\Entity
 * @ORM\AssociationOverrides({
 *      @ORM\AssociationOverride(name="parent")})
 */

class Package extends OpperationObject
{

    /**
     * @ORM\OneToMany(targetEntity="ProjetVoxel\VentesBundle\Entity\OpperationObject", mappedBy="parent")
     */
    protected $content;

	public function getContent(){
		return $this->content;
	}

	public function setContent($content){
		$this->content = $content;
	}

    public function getTotalPrice(){
        $sum = 0;
        foreach ($this->content as $object){
            $sum += $object->getTotalPrice();
        }
        return $sum;
    }
}