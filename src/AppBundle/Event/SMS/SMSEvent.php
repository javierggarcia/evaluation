<?php

namespace AppBundle\Event\SMS;

/**
 * He creado una clase sencilla para enviar por sms por webservice.
 * Podria estar bien utilizar el componente eventdispatcher para crear un evento y lanzar
 * el servicio web.
 * Class SMSEvent
 * @package AppBundle\Event\SMS
 */
class SMSEvent
{

    public function sendSMS($goal_json)
    {
        //Se crea un request y se llama al servicio web
        //$request = Request::create('','','','','','',$goal_json);
    }

}