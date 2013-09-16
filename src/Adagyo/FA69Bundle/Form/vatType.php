<?php

namespace Adagyo\FA69Bundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class vatType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
            ->add('id','hidden')
            ->add('rate')
            ->add('isCurrent');
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Adagyo\FA69Bundle\Entity\vat'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'adagyo_fa69bundle_vat';
    }
}
