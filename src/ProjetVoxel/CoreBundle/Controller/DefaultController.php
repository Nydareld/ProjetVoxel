<?php

namespace ProjetVoxel\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ProjetVoxel\UserBundle\Entity\Notification;

class DefaultController extends Controller
{
    public function indexAction()
    {
        /* Exemple Notification
        $notif = new Notification();
        $notif->setMessage("Zbra");
        $notif->setRoute("projet_voxel_emploi_editEntreprise");
        $notif->setArguments(array('id' => 8 ));
        $notif->setUser($this->get('security.context')->getToken()->getUser());

        $em = $this->getDoctrine()->getManager();
        $em->persist($notif);
        $em->flush();
        */
        return $this->render('ProjetVoxelCoreBundle:Default:index.html.twig');
    }
}
