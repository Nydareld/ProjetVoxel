<?php

namespace ProjetVoxel\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class NotifController extends Controller
{
    public function notifAction($id){
        $notif = $this->getDoctrine()->getManager()->getRepository('ProjetVoxelUserBundle:Notification')->findOneBy(array('id' => $id ));

        $user = $this->get('security.context')->getToken()->getUser();

        if(isset($notif)){ //si la notif existe
            if($notif->getUser() == $user ){ // si c'est bien le bon user

                $route = $notif->getRoute();
                if ( null != $notif->getArguments() ) {
                    $args = $notif->getArguments();
                }else {
                    $args = array();
                }

                $uri = $this->get('router')->generate($route , $args );

                $em = $this->getDoctrine()->getManager();
                $em->remove($notif);
                $em->flush();

                return $this->redirect($uri); // rediriger
            }else{ //sinon
                throw new \Exception("Cette notification ne vous est pas déstinée");
            }
        }else{ //sinon
            throw new \Exception("Cette notification n'existe pas");
        }
    }
}
