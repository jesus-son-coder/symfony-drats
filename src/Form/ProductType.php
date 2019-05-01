<?php

namespace App\Form;

use App\Entity\Product;
use App\Form\CategoryType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('price', MoneyType::class, array(
                'scale'=>2,
                'currency' => false
            ))
            ->add('isSold', CheckboxType::class, [
                'required'=>false
            ])
            // ->add('createdAt')
           //->add('category', CategoryType::class)
           ->add('category', EntityType::class, array(
               'class'=>'App\Entity\Category',
                'choice_label'=>'name',
                'expanded'=>false,
                'multiple'=>false,
                'data' => $options['defaultCategory']
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);

        $resolver->setRequired(array(
            'defaultCategory'
        ));
    }
}
