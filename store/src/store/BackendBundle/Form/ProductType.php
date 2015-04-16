<?php

namespace store\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use store\BackendBundle\Repository\CategoryRepository;
use store\BackendBundle\Repository\CmsRepository;
/**
 * Le suffixe Type est obligatoire pour mes Class Formulaires
 * Class ProductType
 * Formulaire de création de produit
 * @package store\BackendBundle\Form
 */
class ProductType extends AbstractType
{
    /**
     * @var
     */
    protected $user;

    /**
     * @param int $user
     */
    public function __construct($user=null){
        $this->user=$user;
    }
    /**
     * Méthode qui va construire mon formulaire
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //ajoute unn champ dans mon formulaire
        //le nom de mes champs sont des attributs de l'entité Product
        //le 2eme argument à ma fonction add() est de type champ
        //le 3eme argument c'est mes options à mon champs
        $builder->add('title', null, array(
            'label'=>'Titre à mon bijoux',
            'required'=> true,
            'attr'=>array(
                'class'=>'form-control',
                'placeholder'=>'Mettre un titre soigné',
                'pattern'=>'[a-zA-Z0-9- ]{5,}'
            )
        ));

        $builder->add('ref', null, array(
            'label'=>'Référence du produit',
            'required'=> true,
            'attr'=>array(
                'class'=>'form-control',
                'placeholder'=>'AAAA-XX-B',
                'pattern'=>'[A-Z]{4}-[0-9]{2}-[A-Z]{1}'
            )
        ));

        /*$builder->add('category', null, array(
            'label'=>'Catégorie(s) associée(s)',
            'class'=>'storeBackendBundle:Category',
            'property'=>'title',
            'query_builder'=>function(EntityRepository $er){
                    return $er=>createQueryBuilder('c')
                        ->where('c.jeweler=:user')
                        ->orderBy('c.title','ASC')
                        ->setParameter('user',$this->user);
                }
        ));*/

        $builder->add('category','entity',
            array(
                'label' => 'Catégorie',
                'attr'=>array(
                    'class'=>'form-control'
                ),
                'class' => 'storeBackendBundle:Category',
                'property' => 'title',
                'multiple'=> 'true',//choix multiple
                'expanded'=>'true',//checkbox plutot que Liste déroulante. Et pour avoir le checkbox il faut le 'multiple'
                'query_builder'=>function(CategoryRepository $er)
                    {
                        return $er->getCategoryByUserBuilder($this->user);
                    }
            ));
        $builder->add('summary', null, array(
            'label'=>'Petit résumé',
            'required'=> true,
            'attr'=>array(
                'class'=>'form-control',
                'placeholder'=>"Résumé de votre bijoux"
            )
        ));
        $builder->add('description', null, array(
            'label'=>'Déscriptions',
            'required'=> true,
            'attr'=>array(
                'class'=>'form-control',
                'placeholder'=>'Déscriptions longue de votre produits'
            )
        ));
        $builder->add('price',  "money", array(
            'label'=>'Prix HT en €',
            'required'=> true,
            'attr'=>array(
                'class'=>'form-control',
                'placeholder'=>'Prix en €'
            )
        ));
        $builder->add('taxe', 'choice', array(
            'choices'=>array('5'=>'5', '19.6'=>'19.6', '20' => '20'),
            'required'=> true,// liste déroulante obligatoire
            'preferred_choices' => array('20'),// champs choisi par défault
            'label'=>"Taxe appliquée",
            'attr'=>array(
                'class'=>'form-control',
            )
        ));
        $builder->add('quantity', 'number', array(
            'required'=>true,
            'label'=>'Quantité du produit',
            'attr'=>array(
                'class'=>'form-control',
                'pattern'=>'[0-9]{1,4}'
            )
        ));
        $builder->add('active', null, array(
            'label'=>'Produit activé dans la boutique ',
        ));
        $builder->add('cover', null, array(
            'label'=>'Produits mis en couverture dans la boutique? ',
        ));
        $builder->add('cms', null, array(
            'label'=>'Page(s) associée(s) au produit',
            'attr'=>array(
                'class'=>'form-control',
            ),
            'class' => 'storeBackendBundle:Cms',
            'property' => 'title',
            'multiple'=> 'true',//choix multiple
            'query_builder'=>function(CmsRepository $er)
                {
                    return $er->getCmsByUserBuilder($this->user);
                }

        ));
        $builder->add('supplier', null, array(
            'label'=>'Fournisseur(s) associée(s) au produit',
            'attr'=>array(
                'class'=>'form-control',
            )
        ));
        $builder->add('tag', null, array(
            'label'=>'Tag(s) associée(s) au produit',
            'attr'=>array(
                'class'=>'form-control',
            )
        ));
        $builder->add('composition', null, array(
            'label'=>'Composition(s) associée(s) au produit',
            'attr'=>array(
                'class'=>'form-control',
            )
        ));
        $builder->add('dateActive', 'date', array(
            'label'=>"date d'activation du produit",
            'widget'=> 'choice',
            'pattern'=>'{{ day }}-{{ month }}-{{ year }}'
        ));

        /*$builder->add('jeweler');*/
        $builder->add('envoyer','submit', array(
            'attr'=>array(
                'class'=>'btn btn-primary btn-sm',
            )
        ));
    }


    /**
     * Cette méthode me permet de lié mon formulaire à mon Entité Product
     * Car mon formulaire enregistre un produit dans la table product
     * @param OptionResolver $resolver
     */
    public function configureOptions(OptionResolver $resolver)
    {
        //je lis le formulaire à l'entité Product
        $resolver->setDefaults(array(
            'data_class'=>'store\BackendBundle\Entity\Product',
        ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class'=>'store\BackendBundle\Entity\Product',
        ));
    }


    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return "store_backend_product";
    }
}