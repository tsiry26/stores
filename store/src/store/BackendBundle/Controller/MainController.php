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
       $user=$this->getUser();
       // Je récupère le nb de produits de mon bijoutier numéro 1
       // Je fais appel à mon repository ProductRepository
       // et à la fonction getCountByUser
       $nbprod=$em->getRepository('storeBackendBundle:Product')->getCountByUser($user);
       $nbcat=$em->getRepository('storeBackendBundle:Category')->getCountByUser($user);
       $nbcms=$em->getRepository('storeBackendBundle:Cms')->getCountByUser($user);
       $nbcom=$em->getRepository('storeBackendBundle:Comment')->getCountByUser($user);
       $nborders=$em->getRepository('storeBackendBundle:Orders')->getCountByUser($user);
       $lastcom=$em->getRepository('storeBackendBundle:Comment')->getlastComment($user);
       $sum=$em->getRepository('storeBackendBundle:Product')->getSumProduct($user);
       $lastmsg=$em->getRepository('storeBackendBundle:Message')->getLastMessage($user);
       $lastorders=$em->getRepository('storeBackendBundle:Orders')->getLastOrders($user);
       $jeweler=$em->getRepository('storeBackendBundle:JewelerMeta')->getJewelerDetails($user);
       $catgpop=$em->getRepository('storeBackendBundle:Category')->getCategPopular($user);
       $promotion=$em->getRepository('storeBackendBundle:Business')->getPromotion($user);
       $statorder[]=$em->getRepository('storeBackendBundle:Orders')->getOrderGraphByUser($user, new \DateTime('now'));
       $statorder[]=$em->getRepository('storeBackendBundle:Orders')->getOrderGraphByUser($user, new \DateTime('-1 month'));
       $statorder[]=$em->getRepository('storeBackendBundle:Orders')->getOrderGraphByUser($user, new \DateTime('-2 month'));
       $statorder[]=$em->getRepository('storeBackendBundle:Orders')->getOrderGraphByUser($user, new \DateTime('-3 month'));
       $statorder[]=$em->getRepository('storeBackendBundle:Orders')->getOrderGraphByUser($user, new \DateTime('-4 month'));
       $statorder[]=$em->getRepository('storeBackendBundle:Orders')->getOrderGraphByUser($user, new \DateTime('-5 month'));

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
              'jeweler'=>$jeweler,
              'catgpop'=>$catgpop,
              'promotion'=>$promotion,
              'statorder'=>$statorder
          ));
   }
}