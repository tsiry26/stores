<?php

namespace Application;

/*include "User.php";*/

/**
 * Class Moderateur
 */
class Moderateur extends User
{
    /**
     * @var etoile
     */
    protected $etoile;
    /**
     * @var description
     */
    protected $description;

    /**
     * Constructeur d'Objet de ma class Moderateur
     * @param $nom
     * @param $prenom
     * @param $email
     * @param $age
     * @param $etoile
     * @param $description
     */
    public function __construct($nom, $prenom, $email, $age, $etoile, $description=""){

        //appel à mon constructeur parent
        parent::__construct($nom, $prenom, $email, $age);
        $this->description = $description;
        $this->etoile = $etoile;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $etoile
     */
    public function setEtoile($etoile)
    {
        $this->etoile = $etoile;
    }

    /**
     * @return mixed
     */
    public function getEtoile()
    {
        return $this->etoile;
    }

    public function blamer(User $user)
    {
        return $this->nom. " a blamé". $user->nom;
    }
}