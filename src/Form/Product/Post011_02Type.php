<?php

namespace App\Form\Product;

use App\Entity\Product\Post01;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
//use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Post011_02Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('category', EntityType::class, [
                'class'=> 'App\Entity\Product\Category01'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Post01::class,
        ]);
    }
}
