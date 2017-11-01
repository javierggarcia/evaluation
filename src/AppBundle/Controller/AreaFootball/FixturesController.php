<?php

namespace AppBundle\Controller\AreaFootball;

use AppBundle\Services\Data\DataHelper;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


/**
 * Obtiene las Fixtures y se las envia a la vista
 * Class FixturesController
 * @package AppBundle\Controller\AreaFootball
 */
class FixturesController extends Controller
{

    /**
     * Obtiene fixtures guardadas en cache y la envia a la vista
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $myservice3 = $this->get(DataHelper::class);
        $fixture = $myservice3->getFixtures(null);
        return $this->render( ':areafootball:indexFixtures.html.twig', array("fixtures_entries"=>$fixture) );
    }
}
