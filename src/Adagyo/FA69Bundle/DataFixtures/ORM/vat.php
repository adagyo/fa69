<?php

namespace Adagyo\UserBundle\DataFixture\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Adagyo\FA69Bundle\Entity\vat;

class loadVAT implements FixtureInterface {
    public function load(ObjectManager $manager) {
        $VAT = new vat();
        $VAT->setRate(19.6);
        $VAT->setIsCurrent(true);
        $manager->persist($VAT);
        $manager->flush();
    }
}
