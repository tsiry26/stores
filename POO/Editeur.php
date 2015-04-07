<?php

/**
 * Created by PhpStorm.
 * User: wac32
 * Date: 07/04/15
 * Time: 10:16
 */

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

} 