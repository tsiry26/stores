<?php

//declarer le controller
namespace store\BackendBundle\Controller;

//require avec Controller
use store\BackendBundle\Entity\Category;
use store\BackendBundle\Form\CategoryType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
/**
 * Class CategoryController
 *
 */
class CategoryController extends Controller
{
    /**
     * list my category
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user=$this->getUser();
        $categories = $em->getRepository('storeBackendBundle:Category')->getCategoryByUser($user);
        return $this->render('storeBackendBundle:Category:list.html.twig',array('categories'=> $categories)); #Main => nom du dossier
    }

    /**
     * view a category
     * @param $name
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function viewAction($id, $name)
    {
        $em = $this->getDoctrine()->getManager();
        $categorie = $em->getRepository('storeBackendBundle:Category')->find($id);
        // return view de categorie où je transmet l'id en vue
        return $this->render('storeBackendBundle:Category:view.html.twig', array(
            'categorie'=>$categorie
        ));
    }

    /**
     * remove
     */
    public function removeAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $categorie = $em->getRepository('storeBackendBundle:Category')->find($id);
        $em->remove($categorie);
        $em->flush();
        return $this->redirectToRoute('store_backend_category_list');
    }

    public function newAction(Request $request)
    {
        $category=new Category();

        $user=$this->getUser();
        /*$jeweler=$em->getRepository('storeBackendBundle:Jeweler')->find($user);*/
        $category->setJeweler($user);//j'associe mon jewler 1 à mon produit

        //J'initialise la quantité et le prix à mon produit
        /*$product->setQuantity(0);
        $product->setPrice(0);*/

        //créer un formulaire de produit
        $form= $this->createForm(new CategoryType(),$category,
            array(
                'validation_groups'=> 'new',
                'attr'=> array(
                    'method'=>'post',
                    'novalidate'=>'novalidate',
                    'action'=>$this->generateUrl('store_backend_category_new')
                    //action de formulaire pointe vers cette même action de controlleur
                )
            ));

        //je fusionne ma requête avec mon formulaire
        $form->handleRequest($request);

        //si la totalité du formulaire est valide
        if($form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);//j'enregistre mon objet product dans doctrine
            $em->flush();//j'envoi ma requete d'insert à mon table product

            $this->get('session')->getFlashBag()->add(
                'success',
                'Votre catégorie a été bien créer'
            );

            return $this->redirectToRoute('store_backend_category_list'); //redirection selon la route

        }

        return $this->render('storeBackendBundle:Category:new.html.twig',array("form"=> $form->createView()));
    }

    public function editAction(Request $request, $id)
    {

        $em = $this->getDoctrine()->getManager();
        $category=$em->getRepository('storeBackendBundle:Category')->find($id);
       /* $jeweler=$em->getRepository('storeBackendBundle:Jeweler')->find(1);
        $category->setJeweler($jeweler);//j'associe mon jewler 1 à mon produit*/

        //créer un formulaire de produit
        $form= $this->createForm(new CategoryType(),$category,
            array(
                'validation_groups'=> 'edit',
                'attr'=> array(
                    'method'=>'post',
                    'novalidate'=>'novalidate',
                    'action'=>$this->generateUrl('store_backend_category_edit',array('id'=>$id))
                    //action de formulaire pointe vers cette même action de controlleur
                )
            ));

        //je fusionne ma requête avec mon formulaire
        $form->handleRequest($request);

        //si la totalité du formulaire est valide
        if($form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($category);//j'enregistre mon objet product dans doctrine
            $em->flush();//j'envoi ma requete d'insert à mon table product

            $this->get('session')->getFlashBag()->add(
                'success',
                'Votre catégorie a été bien éditer'
            );

            return $this->redirectToRoute('store_backend_category_list'); //redirection selon la route

        }

        return $this->render('storeBackendBundle:Category:edit.html.twig',array("form"=> $form->createView()));
    }

    public function activateAction(Category $id, $action)
    {
        $em = $this->getDoctrine()->getManager();

        $id -> setActive($action);
        $em->persist($id);
        $em->flush();

        $this->get('session')->getFlashBag()->add(
            'success',
            'Votre catégorie a été bien modifié'
        );

        return $this->redirectToRoute('store_backend_category_list');
    }
}