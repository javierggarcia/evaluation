<?php

namespace AppBundle\Services\Data;

use AppBundle\Event\SMS\SMSEvent;
use Symfony\Component\Cache\Simple\FilesystemCache;

/**
 * Servicio para ayudar a manipular los datos con la cache
 * Si se utilizara una base de datos, nos ayudaria mucho en realizar las acciones doctrine
 * Class DataHelper
 * @package AppBundle\Services\Data
 */
class DataHelper{

    /*
     * Si usamos doctrine:
     * $em = $this->getDoctrine()->getEntityManager();
     * $em->getRepository('Demo:A');
    */
    private $cache;

    public function __construct()
    {
        $this->cache = new FilesystemCache();
    }

    /**
     * Insertamos los fixtures
     * @param $datos
     */
    public function saveFixtures($datos){
        $this->createObject('Fixtures',$datos);
    }

    /**
     * Borramos los fixtures
     */
    public function deleteFixtures(){
        $this->deleteObject('Fixtures');
    }

    /**
     * Obtenemos todos los fixtures o el fixture correspondiente al id
     * @param $id
     * @return mixed|null
     */
    public function getFixtures($id){
        $result = null;
        if($id!=null){
            /*
             * Si usamos doctrine:
             * $fixture = $em->getRepository('Demo:Fixtures')->find($id);
             * Busqueda por ID
             */
            $datos = $this->getObject('Fixtures');
            foreach($datos as $dato){
                if($dato->getId()== $id){
                    $result = $dato;
                }
            }
        }else{
            /*
             * Si usamos doctrine:
             * $fixtures = $em->getRepository('Demo:Fixtures')->findAll();
             * Devuelves todos los Fixtures
             * */
            $result = $this->getObject('Fixtures');
        }
        return $result;
    }

    /**
     * Obtenemos fixture correspondiente al id del match
     * @param $id
     * @return null
     */
    public function getFixturesMatch($id){
        $result = null;
        if($id!=null){
            /*
              * Si usamos doctrine:
              * $fixture = $em->getRepository('Demo:Fixtures')->find($id);
              * Busqueda por ID
              */
            $datos = $this->getObject('Fixtures');
            foreach($datos as $dato){
                if($dato->getIdMatch()== $id){
                    $result = $dato;
                }
            }
        }
        return $result;
    }

    /**
     * Logica para crear o actualizar un Match. Detecta si hay diferencia de goals y envia sms.
     * @param $fixture
     * @param $dato
     */
    public function saveMatch($fixture,$dato){
        $foundfix = $this->getFixtures($fixture->getId());

       /*Si no encontramos el fixture, no guardamos el match*/
       if($foundfix!=null) {

           $datos = $this->getMatch( null );
           if ($datos == null) {
               $datos = array();

               /* Creamos desde cero en cache */
               array_push( $datos, $dato );
               $this->createObject( 'Match', $datos );

               //Si tiene goals llamamos SMSEvent
               if(count($dato->getGoals())>0){
                   $sms = new SMSEvent();
                   $sms->sendSMS($dato->getGoals());
               }
           }else{
               /* Buscamos si existe */
               $dato_match = $this->getMatch( $dato->getIdMatch() );
               if($dato_match != null){
                   /* Update Match */
                   for ($i = 0; $i < count($datos); $i++) {
                       if($datos[$i]->getIdMatch()==$dato->getIdMatch()){
                           $datos[$i]=$dato;
                       }
                   }
                   //Si tiene mas goals que antes llamamos SMSEvent
                   if(count($dato->getGoals())>count($dato_match->getGoals())){
                       $sms = new SMSEvent();
                       $sms->sendSMS($dato->getGoals());
                   }
                   $this->updateObject( 'Match', $datos );
               }else{
                   /* Creamos Match */
                   array_push( $datos, $dato );
                   $this->createObject( 'Match', $datos );
               }
           }
       }
    }

    /**
     * Obtenemos el match correspondiente al id
     * @param $id
     * @return null
     */
    public function getMatch($id){
        $result = null;
        if($id!=null){
            /*
            * Si usamos doctrine:
            * $fixture = $em->getRepository('Demo:Match')->find($id);
            * Busqueda por ID
            */
            $datos = $this->getObject('Match');
            foreach($datos as $dato){
                if($dato->getIdMatch()== $id){
                    $result = $dato;
                }
            }
        }else{
            /*
              * Si usamos doctrine:
              * $fixtures = $em->getRepository('Demo:Fixtures')->findAll();
              * Devuelves todos los Fixtures
              * */
            $result = $this->getObject('Match');
        }
        return $result;
    }

    /**
     * Borramos el Match
     */
    public function deleteMatch(){
        $this->deleteObject('Match');
    }

    /**
     * Inserta en la cache un objeto.
     * Si usamos doctrine y queremos eliminar un dato de la base de datos:
     * $em->persist($object);
     * $em->flush();
     * @param $name
     * @param $object
     */
    private function createObject($name,$object)
    {
        $this->cache->set($name, $object);
    }

    /**
     * Borra un objeto de la cache.
     * Si usamos doctrine y queremos eliminar un dato de la base de datos:
     * $em->remove($object);
     * $em->flush();
     * @param $name
     */
    private function deleteObject($name){
        $this->cache->delete($name);
    }

    /**
     * Actualiza un objeto en cache.
     * Si usamos doctrine y queremos actualizar un dato de la base de datos:
     * $em->persist($object);
     * $em->flush();
     * @param $name
     * @param $object
     */
    private function updateObject($name,$object){
        $this->cache->set($name, $object);
    }

    /**
     * Obtiene de la cache un objeto.
     * Si usamos doctrine y queremos obtener un dato de la base de datos:
     * $object = $em->getRepository($name)->findAll();
     * @param $name
     * @return mixed|null
     */
    private function getObject($name){
        return $this->cache->get($name);
    }

}