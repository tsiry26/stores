<?php
/**
 * Created by PhpStorm.
 * User: wac32
 * Date: 22/04/15
 * Time: 15:28
 */

namespace store\BackendBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use store\BackendBundle\Repository\ProductRepository;

class SliderType extends AbstractType
{
    protected $user;

    public function __construct($user=null){
        $this->user=$user;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('caption', null, array(
            'label'=>'Caption',
            'required'=> true,
            'attr'=>array(
                'class'=>'form-control',
                'placeholder'=>'Mettre un caption',
                'pattern'=>'[a-zA-Z0-9- ]{5,}'
            )
        ));

        $builder->add('file', 'file', array(
            'label'=>'Image pour le slide',
            'required'=> false,
            'attr'=>array(
                'class'=>'form-control',
                'accept'=>'image/*',
                'capture'=>'capture'
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

        $builder->add('active', null, array(
            'label'=>'Slider activé ',
        ));


        $builder->add('product', 'entity', array(
            'label'=>'Produit associé au slider',
            'attr'=>array(
                'class'=>'form-control',
            ),
            'class' => 'storeBackendBundle:Product',
            'property' => 'title',
            'multiple'=> false,//choix multiple
            'query_builder'=>function(ProductRepository $er)
                {
                    return $er->getProductByUserBuilder($this->user);
                }

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
            'data_class'=>'store\BackendBundle\Entity\Slider',
        ));
    }

    /**
     * Returns the name of this type.
     *
     * @return string The name of this type
     */
    public function getName()
    {
        return "store_backend_slider";
    }
} 