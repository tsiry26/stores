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
     * Arguments:
     * + $id: l'id de mon objet
     * + $message: le message de notre notification
     * + $nature: product|cms|catégorie
     * Criticity: success - danger - warning - info
     */
    public function notify($id, $message, $nature = 'product', $criticity="success"){

        // nous récupérons dans une variable $tabsession
        // le tableau de notification par sa nature
        // $this->session->get('nature') permete de récupérer une information par sa clef
        // le 2eme argument à la fonction get() permet d'initialiser un tableau vide si ma clef en session n'existe pas
        $tabsession = $this->session->get($nature, array());

        // Nous stockons dans ce tableau la notification avec un message, avec une criticité et une date
        $tabsession[$id] = array(
            'message' => $message,
            'criticity' => $criticity,
            'date' => new \DateTime("now")
        );

        // Nous modifions le tableaux des notifications en session
        $this->session->set($nature, $tabsession);


        /*//La fonction set va mettre en session le message avec la clefs alert
        $this->session->set('alert', array(
            'message' => $message,
            'criticity' => $criticity
        ));*/
    }
} 