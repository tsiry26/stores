<?php

//declarer le controller
namespace store\BackendBundle\Controller;

//require avec Controller
use store\BackendBundle\Entity\Cms;
use store\BackendBundle\Form\CmsType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
/**
 * Class CategoryController
 *
 */
class CMSController extends Controller
{
    /**
     * list my cms
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user=$this->getUser();
        $cms = $em->getRepository('storeBackendBundle:Cms')->getCmsByUser($user);

        // Paginer mes produits
        // je récupere le service knp_paginator qui me sert à paginer
        $paginator  = $this->get('knp_paginator');

        //j'utilise la méthode paginate du service knp_paginator
        $pagination = $paginator->paginate(
            $cms, //je lui envoi mon tableau de produits

            // recupére le numéro de page sur lequel je me trouve et par défaut il prendra la page numéro 1
            $request->query->get('page', 1)/*page number*/,

            //je limite à 5 mes résultats de produits (5 par page)
            1/*limit per page*/
        );

        return $this->render('storeBackendBundle:CMS:list.html.twig', array('cms'=>$pagination)); #Main => nom du dossier
    }

    /**
     * view a cms
     * @param $name
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function viewAction($id, $name)
    {
        // return view de categorie où je transmet l'id en vue
        $em = $this->getDoctrine()->getManager();
        $cms = $em->getRepository('storeBackendBundle:Cms')->find($id);
        return $this->render('storeBackendBundle:CMS:view.html.twig', array(
            'cms'=>$cms
        ));
    }

    public function removeAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $cms = $em->getRepository('storeBackendBundle:Cms')->find($id);
        $em->remove($cms);
        $em->flush();
        return $this->redirectToRoute('store_backend_cms_list');
    }

    public function newAction(Request $request)
    {
        $cms=new Cms();

        $user=$this->getUser();
        /*$jeweler=$em->getRepository('storeBackendBundle:Jeweler')->find($user);*/
        $cms->setJeweler($user);//j'associe mon jewler 1 à mon produit

        //J'initialise la quantité et le prix à mon produit
        /*$product->setQuantity(0);
        $product->setPrice(0);*/

        //créer un formulaire de produit
        $form= $this->createForm(new CmsType($user),$cms,
            array(
                'validation_groups'=> 'new',
                'attr'=> array(
                    'method'=>'post',
                    'novalidate'=>'novalidate',
                    'action'=>$this->generateUrl('store_backend_cms_new')
                    //action de formulaire pointe vers cette même action de controlleur
                )
            ));

        //je fusionne ma requête avec mon formulaire
        $form->handleRequest($request);

        //si la totalité du formulaire est valide
        if($form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em = $this->getDoctrine()->getManager();
            $em->persist($cms);//j'enregistre mon objet product dans doctrine
            $em->flush();//j'envoi ma requete d'insert à mon table product

            $this->get('session')->getFlashBag()->add(
                'success',
                'Votre page cms a été bien créer'
            );


            return $this->redirectToRoute('store_backend_cms_list'); //redirection selon la route

        }

        return $this->render('storeBackendBundle:CMS:new.html.twig',array("form"=> $form->createView()));
    }

    public function editAction(Request $request, $id)
    {

        $em = $this->getDoctrine()->getManager();
        $user=$this->getUser();
        $cms=$em->getRepository('storeBackendBundle:Cms')->find($id);
        $jeweler=$em->getRepository('storeBackendBundle:Jeweler')->find($user);
        $cms->setJeweler($jeweler);//j'associe mon jewler 1 à mon produit


        //créer un formulaire de produit
        $form= $this->createForm(new CmsType(),$cms,
            array(
                'validation_groups'=> 'edit',
                'attr'=> array(
                    'method'=>'post',
                    'novalidate'=>'novalidate',
                    'action'=>$this->generateUrl('store_backend_cms_edit', array('id'=> $id))
                    //action de formulaire pointe vers cette même action de controlleur
                )
            ));

        //je fusionne ma requête avec mon formulaire
        $form->handleRequest($request);

        //si la totalité du formulaire est valide
        if($form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($cms);//j'enregistre mon objet product dans doctrine
            $em->flush();//j'envoi ma requete d'insert à mon table product

            $this->get('session')->getFlashBag()->add(
                'success',
                'Votre page cms a été bien éditer'
            );

            return $this->redirectToRoute('store_backend_cms_list'); //redirection selon la route

        }

        return $this->render('storeBackendBundle:CMS:edit.html.twig',array("form"=> $form->createView()));
    }

    public function activateAction(CMS $id, $action)
    {
        $em = $this->getDoctrine()->getManager();

        $id -> setActive($action);
        $em->persist($id);
        $em->flush();

        if($action == 1){
            $this->get('session')->getFlashBag()->add(
                'success',
                $this->get('translator')->trans('cms.flashdatas.activate', array(), 'cms')
            );
        }else{
            $this->get('session')->getFlashBag()->add(
                'success',
                $this->get('translator')->trans('cms.flashdatas.desactivate', array(), 'cms')
            );
        }

        return $this->redirectToRoute('store_backend_cms_list');
    }

    public function stateAction(CMS $id, $action)
    {
        $em = $this->getDoctrine()->getManager();

        $id -> setState($action);
        $em->persist($id);
        $em->flush();

        $this->get('session')->getFlashBag()->add(
            'success',
            'Votre page cms a été bien modifié'
        );

        return $this->redirectToRoute('store_backend_cms_list');
    }
}