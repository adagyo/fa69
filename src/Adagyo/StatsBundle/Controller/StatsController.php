<?php

namespace Adagyo\StatsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class StatsController extends Controller
{
    public function indexAction() {
        return $this->render('AdagyoStatsBundle:Stats:index.html.twig', array());
    }
}
