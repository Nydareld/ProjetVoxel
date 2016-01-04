<?php

namespace ProjetVoxel\EmploiBundle\Controller;

use ProjetVoxel\EmploiBundle\Form\JobType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ProjetVoxel\EmploiBundle\Entity\Job;
use ProjetVoxel\UserBundle\Entity\User;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Validator\Constraints\IsNull;


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

    public function jobDetailsAction($id){

        $job = $this->getDoctrine()->getManager()->getRepository('ProjetVoxelEmploiBundle:Job')->findOneBy(array('id' => $id));
        $employee = false;
        $appliant = false;
        if(in_array($this->get('security.context')->getToken()->getUser(), $job->getEmployee()->getValues())){
            $employee = True;
        }
        if(in_array($this->get('security.context')->getToken()->getUser(), $job->getAppliant()->getValues())){
            $appliant = True;
        }

        return $this->render('ProjetVoxelEmploiBundle:Job:JobDetails.html.twig', array('job' => $job, 'appliant' => $appliant, 'employee' => $employee));
    }

    public function applyJobAction($id){

        $job = $this->getDoctrine()->getManager()->getRepository('ProjetVoxelEmploiBundle:Job')->findOneBy(array('id' => $id));
        $user = $this->get('security.context')->getToken()->getUser();
        /*
            TO-DO : Add Notif
         */

        $user->setJobApply($job);

        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        return $this->redirect($this->generateUrl('projet_voxel_emploi_jobDetails', array('id' => $job->getId())));
    }

    public function validateAppliantAction($id, $appliantId){

        $job = $this->getDoctrine()->getManager()->getRepository('ProjetVoxelEmploiBundle:Job')->findOneBy(array('id' => $id));
        $user = $job->getAppliantById($appliantId);
        $company = $job->getCompany();

        $user->setJob($job);
        $user->setJobApply(null);

        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        return $this->redirect($this->generateUrl('projet_voxel_emploi_editEntreprise', array('id' => $company->getId())));


    }

    public function refuseAppliantAction($id, $appliantId){

        $job = $this->getDoctrine()->getManager()->getRepository('ProjetVoxelEmploiBundle:Job')->findOneBy(array('id' => $id));
        $user = $job->getAppliantById($appliantId);
        $company = $job->getCompany();



        $user->setJobApply(null);

        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();

        return $this->redirect($this->generateUrl('projet_voxel_emploi_editEntreprise', array('id' => $company->getId())));

    }
}