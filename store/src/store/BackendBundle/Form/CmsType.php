<?php
/**
 * Created by PhpStorm.
 * User: wac32
 * Date: 15/04/15
 * Time: 17:23
 */

namespace store\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CmsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title', null, array(
            'label'=> 'cms.form.title',
            'required'=> true,
            'attr'=>array(
                'class'=>'form-control',
                'placeholder'=>'cms.form.placeholder.title',
                'pattern'=>'[a-zA-Z0-9- ]{5,}'
            )
        ));

        $builder->add('summary', null, array(
            'label'=>'cms.form.summary',
            'required'=> true,
            'attr'=>array(
                'class'=>'form-control',
                'placeholder'=>'cms.form.placeholder.summary'
            )
        ));

        $builder->add('description', null, array(
            'label'=>'Déscriptions',
            'required'=> true,
            'attr'=>array(
                'class'=>'form-control',
                'placeholder'=>'Déscriptions de votre page cms'
            )
        ));

        $builder->add('image', 'url', array(
            'label'=>'Image',
            'required'=> true,
            'attr'=>array(
                'class'=>'form-control',
                'placeholder'=>'Insérer un URL'
            )
        ));

        $builder->add('dateActive', 'date', array(
            'label'=>"date d'activation",
            'widget'=> 'choice',
            'pattern'=>'{{ day }}-{{ month }}-{{ year }}'
        ));

        $builder->add('video', null, array(
            'label'=>'video',
            'required'=> true,
            'attr'=>array(
                'class'=>'form-control',
            )
        ));

        $builder->add('state', 'choice', array(
            'choices'=>array('0'=>'Inactif', '1'=>'En cours de relecture', '2' => 'En ligne'),
            'required'=> true,
            'preferred_choices' => array('0'),
            'label'=>'Etat',
            'attr'=>array(
                'class'=>'form-control',
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
            'data_class'=>'store\BackendBundle\Entity\Cms',
            'translation_domain' => 'cms'
        ));
    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return "store_backend_cms";
    }

}