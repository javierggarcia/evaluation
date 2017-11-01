<?php

namespace AppBundle\Controller\AreaFootball;

use AppBundle\Services\Data\DataHelper;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


/**
 * Obtiene el Match correspondiente y el Fixture asociado a el. Una vez obtenido
 * se lo pasa a la vista
 * Class MatchController
 * @package AppBundle\Controller\AreaFootball
 */
class MatchController extends Controller
{

    /**
     * Show fixtures and match
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        return $this->render( ':areafootball/basic:errorMatch.html.twig', array());
    }

    /**
     * Obtenemos Match y fixture correspondiente para pasarselo a la vista
     */
    public function readAction($id_match){
        $myservice3 = $this->get(DataHelper::class);
        $fixture = $myservice3->getFixturesMatch($id_match);
        $match = $myservice3->getMatch($id_match);
        if($match!=null) {
            return $this->render( ':areafootball:indexMatch.html.twig', array("fixtures_entries" => $fixture, "match_entries" => $match) );
        }else{
            return $this->render( ':areafootball/basic:errorMatch.html.twig', array());
        }
    }
}
