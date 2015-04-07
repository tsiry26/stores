<?php
/**
 * Created by PhpStorm.
 * User: wac32
 * Date: 07/04/15
 * Time: 10:55
 */

/**
 * Class Commercial
 */
class Commercial extends User {
    /**
     * @var mag
     */
    protected $mag;

    /**
     * @var experience
     */
    protected $experience;

    /**
     * @param $nom
     * @param $prenom
     * @param $email
     * @param int $mag
     * @param $experience
     */
    public function  __construct($nom,$prenom,$email,$mag,$experience)
    {
        parent::__construct($nom,$prenom,$email);
        $this -> mag = $mag;
        $this -> experience = $experience;

    }

    /**
     * setExperinence
     * @param mixed $experience
     */
    public function setExperience($experience)
    {
        $this->experience = $experience;
    }

    /**
     * getExperience
     * @return mixed
     */
    public function getExperience()
    {
        return $this->experience;
    }

    /**
     * setMag
     * @param int $mag
     */
    public function setMag($mag)
    {
        $this->mag = $mag;
    }

    /**
     * getMag
     * @return int
     */
    public function getMag()
    {
        return $this->mag;
    }

    /**
     * Les méthodes de classes font des traitements et retourne une ou plusieurs valeurs
     * Vendre un article
     * @return string
     */
    public function vendre()
    {
        return $this->nom ." a vendu un article";
    }

    /**
     * Promotionner un article
     * @return string
     */
    public function promotionner()
    {
        return $this->nom ." a promotionné un article";
    }

} 