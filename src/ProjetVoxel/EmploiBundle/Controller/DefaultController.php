<?php

namespace ProjetVoxel\EmploiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ProjetVoxelEmploiBundle:Default:index.html.twig', array('name' => $name));
    }
}
