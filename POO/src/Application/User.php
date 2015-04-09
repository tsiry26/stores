<?php

namespace Application;

/*include "AbstractUser.php";
include "AuthentificationInterface.php";
include "InscriptionInterface.php";*/
/**
 * Class User
 */
class User extends AbstractUser implements AuthentificationInterface, InscriptionInterface {
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
     * @var age
     */
    protected $age;

    /**
     * Constante de Pays
     */
    const PAYS="France";

    /**
     * Constante de Langues
     */
    const LANGUES = "Français";


    /**
     * Constructeur qui prend 4 paramètres
     * @param $nom
     * @param $prenom
     * @param $email
     * @param $age
     */
    public function __construct($nom, $prenom, $email, $age=26){

        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->age = $age;

    }

    /**
     * désinscription
     * @return mixed
     */
    public function désinscription()
    {
        // TODO: Implement désinscription() method.
    }


    /**
     * set Last Login
     * @param $date
     * @return mixed
     */
    public function setLastLogin($date)
    {
        // TODO: Implement setLastLogin() method.
    }

    /**
     * Get Last Login
     * @return mixed
     */
    public function getLastLogin()
    {
        // TODO: Implement getLastLogin() method.
    }

    /**
     * Set Date Created
     * @param $date
     * @return mixed
     */
    public function setDateCreated($date)
    {
        // TODO: Implement setDateCreated() method.
    }

    /**
     * Get Date Created
     * @return mixed
     */
    public function getDateCreated()
    {
        // TODO: Implement getDateCreated() method.
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
     * get mail
     * @return mixed
     */
    public function getEmail()
    {
        // TODO: Implement getEmail() method.
        return $this -> email;
    }

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
     * get genre
     * @return mixed
     */
    public function getGenre()
    {
        // TODO: Implement getGenre() method.
        return $this->genre;
    }

    /**
     * set genre
     * @param $genre
     * @return mixed
     */
    public function setGenre($genre)
    {
        // TODO: Implement setGenre() method.
        $this -> genre = $genre;
    }

    /**
     * Methode pour commenter
     */
    public function commenter(){
        echo $this->nom."a commenté!";
    }

    /**
     * Repondre à un autre utilisateur
     * @param User $user
     */
    public function repondre(User $user){
        echo $this->nom. "a répondre au commentaire de".$user->nom;
    }

    /**
     * Méthode noter
     */
    public function noter(){
        return $this->nom." a noté!";
    }

    /**
     * chacune des classes doit implémenter sa propre inscription
     * @return mixed
     */
    public function inscription()
    {
        // TODO: Implement inscription() method.
        return "L'utilisateur ".$this->nom." s'est bien inscrit";
    }

    /**
     * @return mixed
     */
    public function connexion()
    {
        // TODO: Implement connexion() method.
        return "L'utilisateur ".$this->nom." s'est bien connecté";
    }

    /**
     * Conversion en chaine de caractère de mon objet
     * @return string
     */
    public function __toString(){
        return $this->nom." ".$this->prenom;
    }

} 