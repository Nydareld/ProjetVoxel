<?php

namespace ProjetVoxel\EmploiBundle\Controller;

use ProjetVoxel\EmploiBundle\Form\CompanyType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ProjetVoxel\EmploiBundle\Entity\Company;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

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

    public function listAction(){

        $companyList = $this->getDoctrine()->getManager()->getRepository('ProjetVoxelEmploiBundle:Company')->findAll();

        return $this->render('ProjetVoxelEmploiBundle:Company:list.html.twig', array('companyList' =>    $companyList));

    }

    public function displayOneAction($id){

        $company = $this->getDoctrine()->getManager()->getRepository('ProjetVoxelEmploiBundle:Company')->findOneBy(array('id' => $id ));

        $manager = False;
        if(in_array($this->get('security.context')->getToken()->getUser(), $company->getManager()->getValues())){
            $manager = True;
        }

        return $this->render('ProjetVoxelEmploiBundle:Company:oneCompany.html.twig', array(
            'company' => $company,
            'manager' => $manager));
    }

    public function editAction($id){

        $request = $this->get('request');
        $company = $this->getDoctrine()->getManager()->getRepository('ProjetVoxelEmploiBundle:Company')->findOneBy(array('id' => $id ));

        // Doit etre une USER sinon ca va bugger quand on va le chercher
        if (!$this->get('security.context')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            throw new AccessDeniedException('Accès limité aux utilisateurs');
        }

        $user = $this->get('security.context')->getToken()->getUser();

        // on verifie qu'il est gérant
        if(!in_array($user, $company->getManager()->getValues())){
            throw new AccessDeniedException("Acces limité aux gérants de l'entreprise");
        }

        $form = $this->get('form.factory')->create(new CompanyType(), $company);

        if ($form->handleRequest($request)->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($company);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Compagnie bien enregistrée.');

            return $this->redirect($this->generateUrl('projet_voxel_emploi_uneCompany', array('id' => $company->getId())));
        }
        return $this->render('ProjetVoxelEmploiBundle:Company:create.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
