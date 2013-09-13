<?php

namespace Adagyo\FA69Bundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;

class HomeController extends Controller {
    public function indexAction() {
        return $this->render('AdagyoFA69Bundle:Home:index.html.twig');
    }
}
