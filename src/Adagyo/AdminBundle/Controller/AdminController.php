<?php

namespace Adagyo\AdminBundle\Controller;

use Adagyo\FA69Bundle\Entity\vat;
use Adagyo\FA69Bundle\Form\vatType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdminController extends Controller {
    public function vatAction() {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository('AdagyoFA69Bundle:vat');
        $newVAT = new vat();
        $newVAT->setIsCurrent(true);

        $currentVAT = $repo->getCurrentVAT();
        $form = $this->createForm(new vatType(), $newVAT)->createView();

        return $this->render('AdagyoAdminBundle:Admin:vat.html.twig', array('currentVAT' => $currentVAT, 'form' => $form));
    }
}
