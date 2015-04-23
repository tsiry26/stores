<?php
/**
 * Created by PhpStorm.
 * User: wac32
 * Date: 22/04/15
 * Time: 15:02
 */

namespace store\BackendBundle\Controller;

use store\BackendBundle\Entity\Slider;
use store\BackendBundle\Form\SliderType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
/**
/**
 * Class SliderController
 * @package store\BackendBundle\Controller
 */
class SliderController extends Controller
{
    public function listAction()
    {

        // récupère le manager de doctrine : le conteneur d'objets de Doctrine
        $em = $this->getDoctrine()->getManager();

        // récupérer l'utilisateur connecté
        $user=$this->getUser();

        // Je récupère tous les produits
        $sliders = $em->getRepository('storeBackendBundle:Slider')->getSliderByUser($user);//Nom du Bundle: Nom de l'entité
        //=Requête: SELECT*FROM product

        return $this->render('storeBackendBundle:Slider:list.html.twig',array('sliders'=> $sliders));
    }

    public function newAction(Request $request)
    {
        $slider=new Slider();

        $user=$this->getUser();

        //créer un formulaire de slider
        $form= $this->createForm(new SliderType($user),$slider,
            array(
                'attr'=> array(
                    'method'=>'post',
                    'novalidate'=>'novalidate',
                    'action'=>$this->generateUrl('store_backend_slider_new')
                    //action de formulaire pointe vers cette même action de controlleur
                )
            ));

        //je fusionne ma requête avec mon formulaire
        $form->handleRequest($request);

        //si la totalité du formulaire est valide
        if($form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $slider->upload();
            $em->persist($slider);
            $em->flush();

            $this->get('session')->getFlashBag()->add(
                'success',
                'Votre slider a été bien créer'
            );

            return $this->redirectToRoute('store_backend_slider_list'); //redirection selon la route

        }

        return $this->render('storeBackendBundle:Slider:new.html.twig',array("form"=> $form->createView()));
    }

    public function editAction(Request $request,Slider $id)
    {
        $em = $this->getDoctrine()->getManager();

        $user=$this->getUser();


        //Je crée un formulaire de produit en associant avec mon produit
        $form= $this->createForm(new SliderType($user),$id,
            array(
                'validation_groups'=> 'edit',
                'attr'=> array(
                    'method'=>'post',
                    'novalidate'=>'novalidate',
                    'action'=>$this->generateUrl('store_backend_slider_edit', array('id' => $id->getId()))
                    //action de formulaire pointe vers cette même action de controlleur
                )
            ));

        //je fusionne ma requête avec mon formulaire
        $form->handleRequest($request);

        //si la totalité du formulaire est valide
        if($form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($id);//j'enregistre mon objet product dans doctrine
            $em->flush();

            return $this->redirectToRoute('store_backend_slider_list'); //redirection selon la route

        }

        return $this->render('storeBackendBundle:Slider:edit.html.twig',array("form"=> $form->createView()));
    }

    public function removeAction($id)
    {
        // récupère le manager de doctrine : le conteneur d'objets de Doctrine
        $em = $this->getDoctrine()->getManager();

        // Je récupère tous les produits de ma base de données avec la méthode findAll
        $slider = $em->getRepository('storeBackendBundle:Slider')->find($id);

        $em->remove($slider);
        $em->flush();

        return $this->redirectToRoute('store_backend_slider_list');
    }
}