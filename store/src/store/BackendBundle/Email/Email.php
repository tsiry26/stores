<?php
/**
 * Created by PhpStorm.
 * User: wac32
 * Date: 24/04/15
 * Time: 14:32
 */

namespace store\BackendBundle\Email;

/**
 * Class Email
 * @package store\BackendBundle\Email
 */
class Email
{
    /**
     * @var \Twig_Environment Twig Template Engine
     */
    protected $twig;

    /**
     * @var \Swift_Mailer
     */
    protected $mailer;
    /**
     * constructeur de ma classe email
     * J'ai besion du service swift mailer et du service Twig
     */
    public function __construct(\Swift_Mailer $mailer, \Twig_Environment $twig){
        $this->mailer = $mailer; //Je stoque mon
        $this->twig=$twig;//je stoque mon
    }
    /**
     * Fonction qui envoi un email à un utilisateur
     */
    public function send(){

        //je créer un message d'email en utilisant Swiftmailer de symfony
        $message = \Swift_Message::newInstance()
            ->setSubject('Hello Email')
            ->setFrom('nialy@live.fr')//l'expéditeur
            ->setTo('nialy@live.fr')//le destinataire
            ->setContentType('text/html')
            ->setBody(
                $this->twig->render('storeBackendBundle:Email:email.html.twig')
            );
        ;
//        $this->mailer->send($message); //utilise le service mailer et envoi l'email avec la méthode send()
    }
} 