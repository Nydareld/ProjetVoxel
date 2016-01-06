<?php

namespace ProjetVoxel\VentesBundle\Controller;

use ProjetVoxel\EconomyBundle\Entity\BankId;
use Symfony\Component\Security\Acl\Exception\Exception;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use ProjetVoxel\VentesBundle\Entity\CatalogueItem;
use ProjetVoxel\VentesBundle\Entity\BasketItem;
use ProjetVoxel\VentesBundle\Form\CatalogueItemType;
use ProjetVoxel\VentesBundle\Form\BasketItemType;

class CatalogueController extends Controller
{
    public function addItemAction($bankId)
    {
        // Si le type est pas co
        if (!$this->get('security.context')->isGranted('ROLE_USER')) {
            // Sinon on déclenche une exception « Accès interdit »
            throw new AccessDeniedException('Accès limité aux utilisateurs');
        }

        // Récupération de l'user et du bank id
        $bankId = $this->getDoctrine()->getManager()->getRepository('ProjetVoxelEconomyBundle:BankId')->findOneBy(array('id' => $bankId ));
        $user = $this->get('security.context')->getToken()->getUser();
        if ($bankId == null) {
            throw new Exception("Cet identité bancaire n'existe pas", 1);

        }
        // Vérification des droits du user sur le bankId ou la company
        if (! $bankId->userHasWright($user) ) {
            throw new AccessDeniedException('Accès limité aux utilisateurs de cet identité bancaire ou aux gérants de son entreprise');
        }
        // Création du formulaire de nouvel item

        $request = $this->get('request');
        $item = new CatalogueItem();
        $form = $this->get('form.factory')->create(new CatalogueItemType(), $item);

        if ($form->handleRequest($request)->isValid()) {

            $item->setBankId($bankId);

            $em = $this->getDoctrine()->getManager();
            $em->persist($item);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Entitée bien ajoutée au catalogue');

            return $this->redirect($this->generateUrl('projet_voxel_ventes_catalogue', array('bankId' => $bankId->getId())));

        }
        return $this->render('ProjetVoxelVentesBundle:Catalogue:addItem.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function viewAction($bankId){
        $bankId = $this->getDoctrine()->getManager()->getRepository('ProjetVoxelEconomyBundle:BankId')->findOneBy(array('id' => $bankId ));
        $hasWright = $bankId->userHasWright($this->get('security.context')->getToken()->getUser());

        return $this->render('ProjetVoxelVentesBundle:Catalogue:view.html.twig', array(
            'bankid' => $bankId ,
            'hasWright' => $hasWright,
        ));
    }
    public function aCatalogueItemAction($bankId, $catalogueItemId){

        $em = $this->getDoctrine()->getManager();

        $bankid = $em->getRepository('ProjetVoxelEconomyBundle:BankId')->findOneBy(array('id' => $bankId ));
        $catalogueItem = $em->getRepository('ProjetVoxelVentesBundle:CatalogueItem')->findOneBy(array('id' => $catalogueItemId ));

        if( $catalogueItem->getBankId() !== $bankid ){
            throw new Exception("Cet article ne coresspond pas a cet identitée bancaire", 1);
        }

        $request = $this->get('request');
        $ajoutAuPanier = new BasketItem();
        $form = $this->get('form.factory')->create(new BasketItemType(), $ajoutAuPanier);

        if ($form->handleRequest($request)->isValid()) {

            $user = $this->get('security.context')->getToken()->getUser();

            $ajoutAuPanier->setBankId($user->getBankId());

            $em = $this->getDoctrine()->getManager();
            $em->persist($ajoutAuPanier);
            $em->flush();

            $request->getSession()->getFlashBag()->add('success', 'Entitée bien ajoutée au panier');

            return $this->redirect($this->generateUrl('projet_voxel_ventes_a_catalogue_item', array('bankId' => $bankId, 'catalogueItemId' => $catalogueItemId)));

        }

        return $this->render('ProjetVoxelVentesBundle:Catalogue:anItem.html.twig', array(
            'form' => $form->createView(),
            'bankid' => $bankid,
            'catalogueItem' => $catalogueItem
        ));

    }
}
