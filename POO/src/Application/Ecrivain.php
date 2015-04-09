<?php
namespace Application;

class Ecrivain extends AbstractUser {
    /**
     * @var biographie
     */
    protected $biographie;

    /**
     * @param \biographie $biographie
     */

    public function setBiographie($biographie)
    {
        $this->biographie = $biographie;
    }

    /**
     * @return \biographie
     */
    public function getBiographie()
    {
        return $this->biographie;
    }

    /**
     * chacune des classes doit implémenter sa propre inscription
     * @return mixed
     */
    public function inscription()
    {
        // TODO: Implement inscription() method.
        return "L'ecrivain ".$this->nom." s'est bien inscrit";
    }

    /**
     * @return mixed
     */
    public function connexion()
    {
        // TODO: Implement connexion() method.
        return "L'ecrivain ".$this->nom." s'est bien connecté";
    }
    public function deconnexion()
    {
        return parent::deconnexion()." l'ecrivain c'est bien déconnecté";
    }
}