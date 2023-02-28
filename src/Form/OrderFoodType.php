<?php

namespace App\Form;

use App\Entity\OrderFood;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrderFoodType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Bill')
            ->add('Food')
            ->add('OrderDate')
            ->add('Quantity')
            ->add('OrderPrice');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => OrderFood::class,
        ]);
    }
}
