<?php

//declarer le controller
namespace store\BackendBundle\Controller;

//require avec Controller
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class StaticsController
 * @package store\BackendBundle\Controller
 */
class StaticsController extends Controller
{
    /**
     * Page Contact
     */
    public function contactAction()
    {
       return $this->render('storeBackendBundle:Statics:contact.html.twig');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function conceptAction()
    {
        return $this->render('storeBackendBundle:Statics:concept.html.twig');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function aboutAction()
    {
        return $this->render('storeBackendBundle:Statics:about.html.twig');
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function termsAction()
    {
        return $this->render('storeBackendBundle:Statics:terms.html.twig');
    }


}