<?php

namespace ProjetVoxel\UserBundle\EventListener;

use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\Event\FilterUserResponseEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use ProjetVoxel\EconomyBundle\Entity\BankId;
use ProjetVoxel\EconomyBundle\Entity\BankAccount;

/**
 * Listener responsible to change the redirection at the end of the password resetting
 */
class RegistrationCompletedListener implements EventSubscriberInterface
{
    private $em;
    public function __construct(\Doctrine\ORM\EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * {@inheritDoc}
     */
    public static function getSubscribedEvents()
    {
        return array(
            FOSUserEvents::REGISTRATION_COMPLETED => 'onRegisterCompleted',
        );
    }

    public function onRegisterCompleted(FilterUserResponseEvent $rep)
    {
        //$url = $this->router->generate('homepage');
        $user = $rep->getUser();

        $bankId = new BankId();
        $bankId->setUser($user);

        $account = new BankAccount();
        $account->setName("Compte courant");
        $account->setOwner($bankId);
        $account->setMain(true);
        $account->setAmount(0);

        $this->em->persist($bankId);
        $this->em->persist($account);
        $this->em->flush();
        //$event->setResponse(new RedirectResponse($url));
    }
}
