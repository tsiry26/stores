<?php
/**
 * Created by PhpStorm.
 * User: wac32
 * Date: 28/04/15
 * Time: 10:56
 */

namespace store\BackendBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use store\BackendBundle\Entity\Message;

/**
 * Class LayoutController
 * Ce controlleur spécial contiendra mon action rendu par twig
 * @package store\BackendBundle\Controller
 */
class LayoutController extends Controller
{
    public function mymessagesAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user=$this->getUser();
        $messages = $em->getRepository('storeBackendBundle:Message')->getLastMessagesByUser($user, 15);
        return $this->render('storeBackendBundle:Partial:mymessages.html.twig',array('messages'=> $messages));
    }

    public function myordersAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user=$this->getUser();
        $orders = $em->getRepository('storeBackendBundle:Orders')->getLastOrdersByUser($user, 15);
        return $this->render('storeBackendBundle:Partial:orders.html.twig',array('orders'=> $orders));
    }
} 