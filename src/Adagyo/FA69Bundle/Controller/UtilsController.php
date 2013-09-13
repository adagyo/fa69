<?php

namespace Adagyo\FA69Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class UtilsController extends Controller {
    public function changePasswordSuccessAction() {
        return $this->render('AdagyoFA69Bundle:Utils:changePasswordSuccess.html.twig');
    }
}