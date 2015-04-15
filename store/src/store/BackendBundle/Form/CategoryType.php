<?php
/**
 * Created by PhpStorm.
 * User: wac32
 * Date: 15/04/15
 * Time: 16:11
 */

namespace store\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title', null, array(
            'label'=>'Titre de la Catégorie',
            'required'=> true,
            'attr'=>array(
                'class'=>'form-control',
                'placeholder'=>'Mettre un titre soigné',
                'pattern'=>'[a-zA-Z0-9- ]{5,}'
            )
        ));

        $builder->add('description', null, array(
            'label'=>'Déscriptions',
            'required'=> true,
            'attr'=>array(
                'class'=>'form-control',
                'placeholder'=>'Déscriptions de votre Categorie'
            )
        ));

        $builder->add('position', 'number', array(
            'required'=>true,
            'label'=>'Position',
            'attr'=>array(
                'class'=>'form-control',
                'pattern'=>'[0-9]{1,2}'
            )
        ));

        $builder->add('envoyer','submit', array(
            'attr'=>array(
                'class'=>'btn btn-primary btn-sm',
            )
        ));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class'=>'store\BackendBundle\Entity\Category',
        ));
    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return "store_backend_category";
    }

} 