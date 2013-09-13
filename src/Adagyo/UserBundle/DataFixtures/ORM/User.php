<?php

namespace Adagyo\UserBundle\DataFixture\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Adagyo\UserBundle\Entity\User;

class Users implements FixtureInterface, ContainerAwareInterface {
    private $container;

    public function setContainer(ContainerInterface $container = null) {
        $this->container = $container;
    }

    public function load(ObjectManager $manager) {
        $userManager = $this->container->get('fos_user.user_manager');

        $user = $userManager->createUser();
        $user->setUsername('admin');
        $user->setPlainPassword('admin');
        $user->setEnabled(1);
        $user->setEmail('alexandre.courtois@fa69.fr');
        $user->addRole('ROLE_SUPER_ADMIN');

        $userManager->updateUser($user);
    }
}
