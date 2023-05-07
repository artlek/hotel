<?php

namespace App\Form;

use App\Entity\Checkin;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class AddCheckinForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $array = [
            'pierwszy typ' => 'aa',
            'drugi typ' => 'bbb',
            'typ trzeci' => 'cc cc',
        ];
        $builder
            ->add('name', TextType::class, ['mapped' => false])
            ->add('surname', TextType::class, ['mapped' => false])
            ->add('type', ChoiceType::class, [
                'choices' => $array,
                'mapped' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Checkin::class,
        ]);
    }
}
