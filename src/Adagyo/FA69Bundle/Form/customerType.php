<?php

namespace Adagyo\FA69Bundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class customerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('id', 'text')
            ->add('civility')
            ->add('firstname')
            ->add('lastname')
            ->add('address')
            ->add('postalcode')
            ->add('city')
            ->add('phone')
            ->add('mobile')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Adagyo\FA69Bundle\Entity\customer'
        ));
    }

    public function getName()
    {
        return 'adagyo_fa69bundle_customertype';
    }
}
