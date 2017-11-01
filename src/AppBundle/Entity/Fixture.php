<?php
/**
 * Created by PhpStorm.
 * User: Javier
 * Date: 29/10/2017
 * Time: 22:27
 */

namespace AppBundle\Entity;

/**
 * Si se utiliza una base de datos, utilizaria doctrine y de esta manera mapeas
 * la entidad con la tabla de la BD.
 *  He decidido no usar BD y por lo tanto no voy ha utlizar Doctrine
 * Class Fixture
 * @package AppBundle\Entity
 */
class Fixture
{
    private $id;
    private $idmatch;
    private $location;
    private $kickoff;
    private $teams;


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getIdMatch()
    {
        return $this->idmatch;
    }

    /**
     * @param mixed $id_match
     */
    public function setIdMatch($idmatch)
    {
        $this->idmatch = $idmatch;
    }

    /**
     * @return mixed
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param mixed $location
     */
    public function setLocation($location)
    {
        $this->location = $location;
    }

    /**
     * @return mixed
     */
    public function getKickoff()
    {
        return $this->kickoff;
    }

    /**
     * @param mixed $kickoff
     */
    public function setKickoff($kickoff)
    {
        $this->kickoff = $kickoff;
    }

    /**
     * @return mixed
     */
    public function getTeams()
    {
        return $this->teams;
    }

    /**
     * @param mixed $teams
     */
    public function setTeams($teams)
    {
        $this->teams = $teams;
    }


}