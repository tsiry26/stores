<?php

/**
 * Class User
 */
class User {
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
     * Constructeur qui prend 4 paramètres
     * @param $nom
     * @param $prenom
     * @param $email
     * @param $age
     */
    public function __construct($nom, $prenom, $email, $age){

        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->age = $age;

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
     * @param \email $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return \email
     */
    public function getEmail()
    {
        return $this->email;
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


} 