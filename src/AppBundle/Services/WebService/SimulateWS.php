<?php

namespace AppBundle\Services\WebService;

use AppBundle\Services\Data\DataHelper;
use AppBundle\Services\Serializer\SerializerHelper;
use Symfony\Component\HttpFoundation\Request;

/**
 * Servicio se encarga de recoger los "request" realizados por un tercero.
 * Una vez recogidos los request, se haran las transformaciones necesarias para guardar los datos.
 * Class SimulateWS
 * @package AppBundle\Services\WebService
 */
class SimulateWS{
    private $serializer;
    private $datahelper;

    public function __construct(SerializerHelper $serializer, DataHelper $datahelper)
    {
        $this->serializer = $serializer;
        $this->datahelper = $datahelper;
    }

    public function webServiceFixtures1(){
        $request = Request::create(
            '/wsfixture',
            'POST',
            array(),
            array(),
            array(),
            array(),
            '[
                {"teams":[
                    {"name":"Black Mesa","result":"2"},{"name":"Aperture Science", "result":"1"}],
                "id":"1",
                "idmatch":"1",
                "location":"Borealis",
                "kickoff":"29/10/2017 21:30"}]'
            );
        $this->workFixtures($request->getContent());
    }

    public function webServiceFixtures2(){
        $request = Request::create(
            '/wsfixture',
            'POST',
            array(),
            array(),
            array(),
            array(),
            '[
                {"teams":[
                    {"name":"Black Mesa","result":"2"},{"name":"Aperture Science", "result":"1"}],
                "id":"1",
                "idmatch":"1",
                "location":"Borealis",
                "kickoff":"29/10/2017 21:30"},
                {"teams":[
                    {"name":"Zerg","result":""},{"name":"Terran", "result":""}],
                "id":"2",
                "idmatch":"2",
                "location":"Marte",
                "kickoff":"29/10/2017 22:00"}]'
        );
        $this->workFixtures($request->getContent());
    }

    public function webServiceMatch1(){
        $request = Request::create(
            '/wsfixture',
            'POST',
            array(),
            array(),
            array(),
            array(),
            '{"fixture":     
                {"teams":[
                    {"name":"Black Mesa","result":"2"},{"name":"Aperture Science", "result":"1"}],
                "id":"1",
                "idmatch":"1",
                "location":"Borealis",
                "kickoff":"29/10/2017 21:30"},
                "match":
                {
                    "idmatch":"1",
                    "players":[{"team":"Black Mesa", "player":["Gordon Freeman","G-Man","Eli Vance"]}],
                    "goals":[{"player":"Gordon Freeman", "time":"29/10/2017 22:02"}],
                    "yellowcards":[{"player":"G-Man", "time":"29/10/2017 21:40"}]
                }     
                }'
        );

        $this->workMatch($request->getContent());
    }

    public function webServiceMatch2(){
        $request = Request::create(
            '/wsfixture',
            'POST',
            array(),
            array(),
            array(),
            array(),
            '{"fixture":     
                {"teams":[
                    {"name":"Black Mesa","result":"2"},{"name":"Aperture Science", "result":"1"}],
                "id":"1",
                "idmatch":"1",
                "location":"Borealis",
                "kickoff":"29/10/2017 21:30"},
                "match":
                {
                    "idmatch":"1",
                    "players":[{"team":"Black Mesa", "player":["Gordon Freeman","G-Man","Eli Vance"]},
                    {"team":"Aperture Science", "player":["GLaDOS","Cubo de compañia","Chell"]}
                    ],
                    "goals":[{"player":"Gordon Freeman", "time":"29/10/2017 22:02"},{"player":"Eli Vance", "time":"29/10/2017 22:12"},{"player":"GLaDOS", "time":"29/10/2017 22:42"}],
                    "yellowcards":[{"player":"G-Man", "time":"29/10/2017 21:40"}]
                }     
                }'
        );

        $this->workMatch($request->getContent());
    }

    /*
     * Cuando el servicio web reciba una peticion de datos con los datos de los Fixtures
     * se llamara a esta funcion para deserailziar y utilizar servidco de DataHelper para
     * guardar los datos. En nuestro caso, se guardaran en cache
     */
    private function workFixtures($content){
        $fixtures = $this->serializer->deserializerObject($content,'AppBundle\Entity\Fixture[]','json');
        $this->datahelper->saveFixtures($fixtures);
    }

    /*
     * Cuando el servicio web reciba una peticion de datos con los datos del Match
     * se llamara a esta funcion para deserailziar y utilizar servidio de DataHelper para
     * guardar los datos. En nuestro caso, se guardaran en cache
     */
    private function workMatch($content){
        $matchcomplete = $this->serializer->deserializerObject($content, 'AppBundle\Entity\MatchComplete', 'json');
        $fixture = $this->serializer->deserializerParcialObject($matchcomplete->getFixture(),'AppBundle\Entity\Fixture','json');
        $match = $this->serializer->deserializerParcialObject($matchcomplete->getMatch(),'AppBundle\Entity\Match','json');
        $this->datahelper->saveMatch($fixture,$match);
    }
}