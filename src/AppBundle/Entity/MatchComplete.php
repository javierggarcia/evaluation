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
 * He decidido no usar BD y por lo tanto no voy ha utlizar Doctrine
 * Class MatchComplete
 * @package AppBundle\Entity
 */
class MatchComplete
{
    private $fixture;
    private $match;

    /**
     * @return mixed
     */
    public function getFixture()
    {
        return $this->fixture;
    }

    /**
     * @param mixed $fixture
     */
    public function setFixture($fixture)
    {
        $this->fixture = $fixture;
    }

    /**
     * @return mixed
     */
    public function getMatch()
    {
        return $this->match;
    }

    /**
     * @param mixed $match
     */
    public function setMatch($match)
    {
        $this->match = $match;
    }


}