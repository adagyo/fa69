<?php

namespace Adagyo\UserBundle\EventListener;

use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/**
 * Listener responsible to change the redirection at the end of the password changing
 */
class ChangePasswordListener implements EventSubscriberInterface {
    private $router;

    public function __construct(UrlGeneratorInterface $router) {
        $this->router = $router;
    }

    public static function getSubscribedEvents() {
        return [
            FOSUserEvents::CHANGE_PASSWORD_SUCCESS => 'onChangePasswordSuccess',
        ];
    }

    public function onChangePasswordSuccess(FormEvent $event) {
        $url = $this->router->generate('utils_changepassword_success');
        $event->setResponse(new RedirectResponse($url));
    }
}