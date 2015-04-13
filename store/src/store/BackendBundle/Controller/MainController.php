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
       $em=$this->getDoctrine()->getManager();
       // Je récupère le nb de produits de mon bijoutier numéro 1
       // Je fais appel à mon repository ProductRepository
       // et à la fonction getCountByUser
       $nbprod=$em->getRepository('storeBackendBundle:Product')->getCountByUser(1);
       $nbcat=$em->getRepository('storeBackendBundle:Category')->getCountByUser(1);
       $nbcms=$em->getRepository('storeBackendBundle:Cms')->getCountByUser(1);
       $nbcom=$em->getRepository('storeBackendBundle:Comment')->getCountByUser(1);
       $nborders=$em->getRepository('storeBackendBundle:Orders')->getCountByUser(1);
       $lastcom=$em->getRepository('storeBackendBundle:Comment')->getlastComment(1);
       $sum=$em->getRepository('storeBackendBundle:Product')->getSumProduct(1);
       $lastmsg=$em->getRepository('storeBackendBundle:Message')->getLastMessage(1);
       $lastorders=$em->getRepository('storeBackendBundle:Orders')->getLastOrders(1);
      return $this->render('storeBackendBundle:Main:index.html.twig',
          array(
              'nbprod'=>$nbprod,
              'nbcat'=>$nbcat,
              'nbcms'=>$nbcms,
              'nbcom'=>$nbcom,
              'nborders'=>$nborders,
              'lastcom'=>$lastcom,
              'sum'=>$sum,
              'lastmsg'=>$lastmsg,
              'lastorders'=>$lastorders,
          ));
   }
}