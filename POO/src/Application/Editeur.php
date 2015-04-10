<?php

namespace Application;

/**
 * Class Editeur
 */
class Editeur extends User {

    /**
     * @var presse
     */
    protected $presse;

    /**
     * @param $nom
     * @param $prenom
     * @param $mail
     * @param $presse
     */
    public function __construct($nom,$prenom,$email,$presse)
    {
        parent::__construct($nom,$prenom,$email);
        $this -> presse = $presse;
    }

    /**
     * setPresse
     * @param \presse $presse
     */
    public function setPresse($presse)
    {
        $this->presse = $presse;
    }

    /**
     * getPresse
     * @return \presse
     */
    public function getPresse()
    {
        return $this->presse;
    }

    /**
     * Ecrase la méthode repondre dans la classe parent
     * @param User $user
     * @return string|void
     */
    public function repondre(User $user)
    {
        return $this->nom. " réponds au commentaire de ".$user->nom;
    }

} 