<?php

namespace ProjetVoxel\EmploiBundle\Controller;

use ProjetVoxel\EmploiBundle\Form\JobType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ProjetVoxel\EmploiBundle\Entity\Job;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\Security\Core\Security;


class JobController extends Controller
{
    public function createAction($id){
        // On vérifie que l'utilisateur dispose bien du rôle ROLE_AUTEUR
        if (!$this->get('security.context')->isGranted('ROLE_USER')) {
            // Sinon on déclenche une exception « Accès interdit »
            throw new AccessDeniedException('Accès limité aux utilisateurs');
        }
        $request = $this->get('request');
        $job = new Job();
        $form = $this->get('form.factory')->create(new JobType(), $job);
        $company = $this->getDoctrine()->getManager()->getRepository('ProjetVoxelEmploiBundle:Company')->findOneBy(array('id' => $id ));

        if($form->handleRequest($request)->isValid()){

            $job->setCompany($company);
            $em = $this->getDoctrine()->getManager();
            $em->persist($job);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Emploi bien créé');
            return $this->redirect($this->generateUrl('projet_voxel_emploi_uneCompany', array('id' => $id)));
        }


        return $this->render('ProjetVoxelEmploiBundle:Company:create.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}