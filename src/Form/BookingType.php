<?php

namespace App\Form;

use App\Entity\Reservation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;


class BookingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, [
                'label'    => 'Prénom'
            ])
            ->add('lastname', TextType::class, [
                'label'    => 'Nom de famille'
            ])
            ->add('pronoun', TextType::class, [
                'label'    => 'Quel(s) pronom(s) utilises-tu?'
            ])
            ->add('email', EmailType::class, [
                'label'    => 'Email'
            ])
            ->add('telephone', TextType::class, [
                'label'    => 'Numéro de téléphone'
            ])
            ->add('location', TextType::class, [
                'label'    => 'Emplacement souhaité',
                'required' => false,
            ])
            ->add('size', TextType::class, [
                'label'    => 'Taille (en cm)'
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}
