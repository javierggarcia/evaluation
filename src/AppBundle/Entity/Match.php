<?php

namespace AppBundle\Entity;

/**
 * Si se utiliza una base de datos, utilizaria doctrine y de esta manera mapeas
 * la entidad con la tabla de la BD.
 *  He decidido no usar BD y por lo tanto no voy ha utlizar Doctrine
 * Class Match
 * @package AppBundle\Entity
 */
class Match
{
    private $idmatch;
    private $players;
    private $goals;
    private $yellowcards;

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
    public function getPlayers()
    {
        return $this->players;
    }

    /**
     * @param mixed $players
     */
    public function setPlayers($players)
    {
        $this->players = $players;
    }

    /**
     * @return mixed
     */
    public function getGoals()
    {
        return $this->goals;
    }

    /**
     * @param mixed $goals
     */
    public function setGoals($goals)
    {
        $this->goals = $goals;
    }

    /**
     * @return mixed
     */
    public function getYellowcards()
    {
        return $this->yellowcards;
    }

    /**
     * @param mixed $yellowcards
     */
    public function setYellowcards($yellowcards)
    {
        $this->yellowcards = $yellowcards;
    }


}