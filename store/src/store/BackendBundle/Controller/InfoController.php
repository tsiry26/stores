<?php
/**
 * Created by PhpStorm.
 * User: wac32
 * Date: 27/04/15
 * Time: 10:18
 */

namespace store\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class InfoController extends Controller
{
    public function listAction(){
        $em = $this->getDoctrine()->getManager();
        $user=$this->getUser();
        $jeweler=$em->getRepository('storeBackendBundle:JewelerMeta')->getJewelerDetails($user);
        return $this->render('storeBackendBundle:Info:list.html.twig',array('jeweler'=> $jeweler));
    }
} 