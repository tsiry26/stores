<?php
/**
 * Created by PhpStorm.
 * User: wac32
 * Date: 24/04/15
 * Time: 17:06
 */

namespace store\BackendBundle\Notification;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Service de Notification
 * Class Notification
 * @package store\BackendBundle\Notification
 */
class Notification {

    protected $session;
    /**
     * Constructeur qui recevra mon service en session
     */
    public function __construct(Session $session){
        $this->session = $session;
    }

    /**
     * Methode qui va notifier une action
     * Criticity: success - danger - warning - info
     */
    public function notify($message, $criticity="success"){
        //La fonction set va mettre en session le message avec la clefs alert
        $this->session->set('alert', array(
            'message' => $message,
            'criticity' => $criticity
        ));
    }
} 