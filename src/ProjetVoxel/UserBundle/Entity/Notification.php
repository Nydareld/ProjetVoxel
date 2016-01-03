<?php

namespace ProjetVoxel\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity @ORM\Table(name="notification")
 **/
class Notification{
    /**
     * @ORM\Id @ORM\GeneratedValue @ORM\Column(type="integer")
     * @var int
     */
    private $id;
    /**
     * @ORM\Column(type="string")
     */
    private $message;  // Message de la Notification
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $route;   // Lien vers ou la notification pointe quand on clic dessus

    /**
     * @var array
     *
     * @ORM\Column(name="arguments", type="array")
     */
    private $arguments;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="notif")
     */
    private $user;

    public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getMessage(){
		return $this->message;
	}

	public function setMessage($message){
		$this->message = $message;
	}

	public function getRoute(){
		return $this->route;
	}

	public function setRoute($route){
		$this->route = $route;
	}

	public function getArguments(){
		return $this->arguments;
	}

	public function setArguments($arguments){
		$this->arguments = $arguments;
	}

	public function getUser(){
		return $this->user;
	}

	public function setUser($user){
		$this->user = $user;
	}

}

/*

Ajouter notif : (dans nimporte quel Controller)

1./ tu crée une notif
2./ tu lui atribue l'User
3./ tu la sauvegarde

clicker sur la notif dans le template va vers la route de notif qui redirge vers la bonne url

*/

/*
route : ATTENTION c'est du silex pas du symf donc proche mais pas pareil
*/

/*$app->match('/notification/{notifid}/{notifpath}', "Zrtcommunity\Controller\HomeController::notifAction");

/*
Controller : ATTENTION c'est du silex pas du symf donc proche mais pas pareil
*/
/*
public function notifAction($notifid,$notifpath,Request $request, Application $app){
    $notif = $app['dao.notification']->loadNotifById($notifid); //chercher la notif
    $path = str_replace('.','/',$notifpath); //remetre bien le lien par ce que silex le fait mal mais symf le fait bien avec la fct path()
    if(isset($notif)){ //si la notif existe
        if($notif->getUser() == $app['security']->getToken()->getUser() ){ // si c'est bien le bon user
            $app['dao.notification']->remove($notif); // suprimer la notif
            return $app->redirect($request->getBasePath().'/'.$path); // rediriger
        }else{ //sinon
            throw new \Exception("Cette notification n'existe pas ou ne vous est pas déstinée");
        }
    }else{
        return $app->redirect($request->getBasePath().'/'.$path); // rediriger
    }
}
*/
