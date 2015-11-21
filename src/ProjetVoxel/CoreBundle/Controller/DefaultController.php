<?php

namespace ProjetVoxel\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ProjetVoxelCoreBundle:Default:index.html.twig');
    }
}
