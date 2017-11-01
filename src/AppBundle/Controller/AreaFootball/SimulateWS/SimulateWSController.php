<?php
namespace AppBundle\Controller\AreaFootball\SimulateWS;
use AppBundle\Services\Data\DataHelper;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Creamos este controller para simular las diversas llamadas que hace un externo
 * para darnos datos.
 * Page=0 -> borra datos de fixtures y match
 * Page=1 (default) -> envia fixtures
 * Page=2 -> envia un nuevo fixture y envia los match
 * Page=3 -> envia match actualizados
 * Class AreaFootballController
 * @package AppBundle\Controller\AreaFootball\SimulateWS
 */
class SimulateWSController extends Controller
{

    /**
     * Genera request segun el page
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction($page)
    {
        $myservice2 = $this->get(\AppBundle\Services\WebService\SimulateWS::class);
        $myservice3 = $this->get(DataHelper::class);
        $datos = null;
        switch($page) {
            case 0:
                $myservice3->deleteFixtures();
                $myservice3->deleteMatch();
                break;
            case 1:
                $myservice2->webServiceFixtures1();
                break;
            case 2:
                $myservice2->webServiceFixtures2();
                $myservice2->webServiceMatch1();
                break;
            case 3:
                $myservice2->webServiceMatch2();
               break;
            default:
        }

        return $this->render( ':areafootball:indexArea.html.twig', array());
    }
}
