<?php

namespace ProjetVoxel\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ProjetVoxelUserBundle:Default:index.html.twig', array('name' => $name));
    }
}
