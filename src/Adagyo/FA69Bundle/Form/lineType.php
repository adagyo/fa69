<?php

namespace Adagyo\FA69Bundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class lineType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('number',       'hidden')
            ->add('lineLabel',    'text')
            ->add('quality',      'text')
            ->add('quantity',     'number')
            ->add('discount',     'number')
            ->add('unitPriceVAT', 'number')
            //->add('bill')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Adagyo\FA69Bundle\Entity\line'
        ));
    }

    public function getName()
    {
        return 'adagyo_fa69bundle_linetype';
    }
}
