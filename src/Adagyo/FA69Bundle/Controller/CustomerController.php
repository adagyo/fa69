<?php

namespace Adagyo\FA69Bundle\Controller;


use Adagyo\FA69Bundle\Form\customerType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Response;


class CustomerController extends Controller {
    public function searchAction() {
        return $this->render('AdagyoFA69Bundle:Customer:search.html.twig');
    }

    public function editAction($id) {
        $em = $this->getDoctrine()->getManager();
        $repository = $em->getRepository('AdagyoFA69Bundle:customer');
        $customer = $repository->find($id);

        if(!$customer) {
            throw $this->createNotFoundException("Ce client n'existe pas!");
        }
        $form = $this->createForm(new customerType(), $customer);
        return $this->render('AdagyoFA69Bundle:Customer:edit.html.twig', array('form' => $form->createView()));
    }
}