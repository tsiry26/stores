<?php

//declarer le controller
namespace store\BackendBundle\Controller;

//require avec Controller
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class MainController
 * @package store\BackendBundle\Controller
 */
class MainController extends Controller
{
    /**
     * Page Dashboard on Backend
     */
    public function indexAction()
   {
      return $this->render('storeBackendBundle:Main:index.html.twig');
   }
}