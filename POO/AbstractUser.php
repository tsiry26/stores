<?php

/**
 * Class AbstractUser
 * Nomenclature: Mon nom de classe abstraite est préfixé par le mot "Abstract"
 * Class qui me sert de modèle aux classes filles qui hériteront de cette classe
 */
abstract class AbstractUser{

    /**
     * @var genre
     */
    protected $genre;
    /**
     * @var nom
     */
    protected $nom;
    /**
     * @var prenom
     */
    protected $prenom;
    /**
     * @var email
     */
    protected $email;

    /**
     * set email
     * il faut parametrer la variable email dans la classe abstraite
     * @return mixed
     */
    public function setEmail($email)
    {
        // TODO: Implement setEmail() method.
        $this -> email = $email;
    }


    /**
     * @param \nom $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return \nom
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param \prenom $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    /**
     * @return \prenom
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param \age $age
     */
    public function setAge($age)
    {
        $this->age = $age;
    }

    /**
     * @return \age
     */
    public function getAge()
    {
        return $this->age;
    }


    /**
     * get genre
     * @return mixed
     */
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * set genre
     * @param $genre
     * @return mixed
     */
    public function setGenre($genre)
    {
        $this -> genre = $genre;
    }

    /**
     * chacune des classes doit implémenter sa propre inscription
     * @return mixed
     */
    public abstract  function inscription();

    /**
     * @return mixed
     */
    public abstract function connexion();

    /**
     * deconnexion
     * @return string
     */
    public function deconnexion()
    {
        return $this->getNom()." c'est bien déconnecté";
    }

}