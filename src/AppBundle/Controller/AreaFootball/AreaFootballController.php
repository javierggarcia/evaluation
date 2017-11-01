<?php

namespace AppBundle\Controller\AreaFootball;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AreaFootballController extends Controller
{

    /**
     * Show general area
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        return $this->render( ':areafootball:indexArea.html.twig', array());
    }
}
