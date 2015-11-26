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
}
