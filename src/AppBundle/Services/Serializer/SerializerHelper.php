<?php

namespace AppBundle\Services\Serializer;

use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * Servicio para ayudar a deserializar y serializar Entidades
 * Class SerializerHelper
 * @package AppBundle\Services\Serializer
 */
class SerializerHelper{

    private $serializer;

    public function __construct()
    {
        $encoders = array(new XmlEncoder(),new JsonEncoder());
        $normalizers = array(new GetSetMethodNormalizer(),new ArrayDenormalizer());
        $this->serializer = new Serializer($normalizers, $encoders);
    }

    public function deserializerObject($data,$type,$format)
    {
        $object = $this->serializer->deserialize( $data, $type, $format);
        return $object;
    }

    public function serializerObject($data,$format){
        $content =  $this->serializer->serialize($data, $format);
        return $content;
    }

    public function deserializerParcialObject($parcialObject,$typeparcial,$format){
        $jsonContent = $this->serializer->serialize($parcialObject, $format);
        $parcialObjectDeserializer = $this->serializer->deserialize($jsonContent, $typeparcial, $format);
        return $parcialObjectDeserializer;
    }
}