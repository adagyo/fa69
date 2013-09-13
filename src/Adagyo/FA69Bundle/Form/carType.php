<?php

namespace Adagyo\FA69Bundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class carType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('id','hidden')
            ->add('regPlate')
            ->add('brand')
            ->add('year')
            ->add('mileage', 'integer')
            //->add('customer')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Adagyo\FA69Bundle\Entity\car'
        ));
    }

    public function getName()
    {
        return 'adagyo_fa69bundle_cartype';
    }
}
