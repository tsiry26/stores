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
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $cms = $em->getRepository('storeBackendBundle:Cms')->getCmsByUser(1);
        return $this->render('storeBackendBundle:CMS:list.html.twig', array('cms'=>$cms)); #Main => nom du dossier
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

        $em = $this->getDoctrine()->getManager();
        $jeweler=$em->getRepository('storeBackendBundle:Jeweler')->find(1);
        $cms->setJeweler($jeweler);//j'associe mon jewler 1 à mon produit

        //J'initialise la quantité et le prix à mon produit
        /*$product->setQuantity(0);
        $product->setPrice(0);*/

        //créer un formulaire de produit
        $form= $this->createForm(new CmsType(),$cms,
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
        $cms=$em->getRepository('storeBackendBundle:Cms')->find($id);
        $jeweler=$em->getRepository('storeBackendBundle:Jeweler')->find(1);
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
}