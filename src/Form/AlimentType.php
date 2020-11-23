<?php

namespace App\Form;

use App\Entity\Type;
use App\Entity\Aliment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class AlimentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class,['label' => "Nom de l'aliment"])
            ->add('price', NumberType::class,['label' => "Prix de l'aliment"])
            ->add('calory', NumberType::class,['label' => "Nombre de calorie"])
            ->add('proteine', NumberType::class,['label' => "Nombre de proteine"])
            ->add('glucide', NumberType::class,['label' => "Nombre de glucide"])
            ->add('lipide', NumberType::class,['label' => "Nombre de lipide"])
            ->add('type', EntityType::class,[
                'class' => Type::class, 
                'choice_label' => "name"
            ])
            ->add('imageFile', FileType::class, ['label' => "ajouter une image", "required" => false])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Aliment::class,
        ]);
    }
}
