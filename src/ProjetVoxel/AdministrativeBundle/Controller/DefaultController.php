<?php

namespace ProjetVoxel\AdministrativeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ProjetVoxelAdministrativeBundle:Default:index.html.twig', array('name' => $name));
    }
}
