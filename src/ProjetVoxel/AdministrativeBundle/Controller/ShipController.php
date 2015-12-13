<?php
/**
 * Created by PhpStorm.
 * User: 16542_000
 * Date: 01/12/2015
 * Time: 16:30
 */

namespace ProjetVoxel\AdministrativeBundle\Controller;

use ProjetVoxel\AdministrativeBundle\Entity\Ship;
use ProjetVoxel\AdministrativeBundle\Form\ShipType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class ShipController extends controller
{
    public function registerAction(){
        // On vérifie que l'utilisateur dispose bien du rôle ROLE_AUTEUR
        if (!$this->get('security.context')->isGranted('ROLE_USER')) {
            // Sinon on déclenche une exception « Accès interdit »
            throw new AccessDeniedException('Accès limité aux utilisateurs');
        }
        $request = $this->get('request');
        $ship = new Ship();
        $form = $this->get('form.factory')->create(new ShipType(), $ship);

        if ($form->handleRequest($request)->isValid()) {

            $em = $this->getDoctrine()->getManager();

            $em->persist($ship);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Votre vaisseau à bien été enregistré bien enregistrée.');

            return $this->redirect($this->generateUrl('projet_voxel_administrative_Immatriculation', array('id' => $ship->getId())));
        }
        return $this->render('ProjetVoxelAdministrativeBundle:Ship:register.html.twig', array(
            'form' => $form->createView(),
        ));
    }

}