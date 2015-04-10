<?php
/**
 * Created by PhpStorm.
 * User: wac32
 * Date: 10/04/15
 * Time: 10:57
 */

namespace Application;


/**
 * Class Vrp
 * Une classe qui ne peut s'hériter
 * @package Application
 */
final class Vrp extends Commercial {
    /**
     * @var ecommerce
     */
    protected $ecommerce;
    /**
     * @var commissions
     */
    protected $commissions;

    /**
     * @param $commissions
     * @param $ecommerce
     */
    public function __construct($ecommerce,$commissions)
    {
        $this->commissions = $commissions;
        $this->ecommerce = $ecommerce;
    }

    /**
     * @param \Application\commissions $commissions
     */
    public function setCommissions($commissions)
    {
        $this->commissions = $commissions;
    }

    /**
     * @return \Application\commissions
     */
    public function getCommissions()
    {
        return $this->commissions;
    }

    /**
     * @param \Application\ecommerce $ecommerce
     */
    public function setEcommerce($ecommerce)
    {
        $this->ecommerce = $ecommerce;
    }

    /**
     * @return \Application\ecommerce
     */
    public function getEcommerce()
    {
        return $this->ecommerce;
    }

} 