<?php

namespace Adagyo\FA69Bundle\Controller;

use Adagyo\FA69Bundle\Entity\bill;
use Adagyo\FA69Bundle\Entity\line;
use Adagyo\FA69Bundle\Form\billType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Response;


class BillController extends Controller {
    public function newAction() {
        $bill = new bill();
        for($i = 1; $i < 18; $i++) {
            $line = new line();
            $line->setNumber($i);
            $bill->addLine($line);
        }
        $bill->setVatRate($this->getDoctrine()->getManager()->getRepository('AdagyoFA69Bundle:vat')->getCurrentVAT());
        $form = $this->createForm(new billType(), $bill);

        return $this->render('AdagyoFA69Bundle:Bill:create.html.twig', array('form' => $form->createView()));
    }

    public function searchAction() {
        return $this->render('AdagyoFA69Bundle:Bill:search.html.twig');
    }
}