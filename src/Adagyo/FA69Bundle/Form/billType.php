<?php

namespace Adagyo\FA69Bundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class billType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('id', 'hidden')
            ->add('date','text')
            ->add('settlementDate')
            ->add('paymentMethod')
            ->add('totalExVATNewPart', 'text', array('read_only' => true))
            ->add('totalVATNewPart', 'text', array('read_only' => true))
            ->add('totalExVATOldPart', 'text', array('read_only' => true))
            ->add('totalDiscount', 'text', array('read_only' => true))
            ->add('VAT', 'text', array('read_only' => true))
            ->add('totalAmount', 'text', array('read_only' => true))
            ->add('customer', new customerType())
            ->add('car', new carType())
            ->add('lines', 'collection', array('type' => new lineType(), 'allow_add' => false, 'allow_delete' => false))
            ->add('carMileage', 'hidden')
            ->add('vatRate', new vatType())
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Adagyo\FA69Bundle\Entity\bill'
        ));
    }

    public function getName() {
        return 'adagyo_fa69bundle_billtype';
    }
}
