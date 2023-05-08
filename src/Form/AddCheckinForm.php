<?php

namespace App\Form;

use App\Entity\Checkin;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Doctrine\ORM\EntityManagerInterface;
use App\Service\GetRoomTypes;

class AddCheckinForm extends AbstractType
{
    private $em;

    public function __construct(EntityManagerInterface $em, GetRoomTypes $arrayTypes)
    {
        $this->em = $em;
        $this->arrayTypes = $arrayTypes;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, ['mapped' => false])
            ->add('surname', TextType::class, ['mapped' => false])
            ->add('telephone', NumberType::class, ['mapped' => false])
            ->add('type', ChoiceType::class, [
                'choices' => $this->arrayTypes->get(),
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
