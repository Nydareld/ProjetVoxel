<?php

namespace ProjetVoxel\EmploiBundle\Controller;

use ProjetVoxel\EmploiBundle\Form\CompanyType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ProjetVoxel\EmploiBundle\Entity\Company;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\Security\Core\Security;

class CompanyController extends Controller
{
    public function createAction(){
        // On vérifie que l'utilisateur dispose bien du rôle ROLE_AUTEUR
        if (!$this->get('security.context')->isGranted('ROLE_USER')) {
            // Sinon on déclenche une exception « Accès interdit »
            throw new AccessDeniedException('Accès limité aux utilisateurs');
        }
        $request = $this->get('request');
        $company = new Company();
        $company->setCreationDate(new \DateTime());
        $user = $this->get('security.context')->getToken()->getUser();
        $company->setCreator($user);
        $form = $this->get('form.factory')->create(new CompanyType(), $company);

        if ($form->handleRequest($request)->isValid()) {
            $user->setManagedCompany($company);
            $user->setOwnedCompany($company);
            $em = $this->getDoctrine()->getManager();
            $em->persist($company);
            $em->persist($user);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Compagnie bien enregistrée.');

            return $this->redirect($this->generateUrl('projet_voxel_core_homepage', array('id' => $company->getId())));
        }
        return $this->render('ProjetVoxelEmploiBundle:Company:create.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}