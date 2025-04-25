<?php

namespace App\Form;

use App\Entity\Vehicle;
use App\Entity\Reservation;
use Dom\Attr;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

// src/Form/ReservationType.php
class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('vehicle', EntityType::class, [
                'label' => 'Véhicule',
                'class' => Vehicle::class,
                // 'choices' => $options['disabled'] ? null : $options['vehiclesAvailable'],
                'choices' => $options['vehiclesAvailable'],
                'choice_label' => function(Vehicle $vehicle) {
                    return $vehicle->getMarque() . ' ' . $vehicle->getModele() . ' - ' . $vehicle->getImmat();
                }
                
            ])
            ->add('startDate', DateTimeType::class, [
                'label' => 'Date de début',
                'widget' => 'single_text',
                'html5' => false,
                'attr' => ['class' => 'datetimepicker', 'placeholder' => 'Champ obligatoire'],
            ])
            ->add('endDate', DateTimeType::class, [
                'label' => 'Date de fin',
                'widget' => 'single_text',
                'html5' => false,
                'attr' => ['class' => 'datetimepicker', 'placeholder' => 'Champ obligatoire'],
            ])
            ->add('customerName', TextType::class, ['label' => 'Service','required' => true,'attr' => ['placeholder' => 'Champ obligatoire']]);
            // ->add('submit', SubmitType::class, ['label' => 'Réserver']);
    }


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
            'vehiclesAvailable' => [], 
            'disabled' => false,
        ]);
    }
   
}
