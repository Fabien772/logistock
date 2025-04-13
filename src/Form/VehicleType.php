<?php

namespace App\Form;

use App\Entity\Vehicle;
use Doctrine\DBAL\Types\BooleanType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class VehicleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('marque',)
            ->add('immat')
            ->add('modele')
            ->add('dateAquisition', DateType::class, ['label' => 'Date d\'acquisition', 'widget' => 'single_text',])
            ->add('attribution')
            ->add('numeroPlace', TextType::class, ['label' => 'Numero de place', 'attr' => ['placeholder' => 'Numero de place']])
            ->add('equipementPolice', CheckboxType::class, ['label' => 'Equipement de police', 'required' => false,])
            ->add('pret', CheckboxType::class, ['label' => 'Pret', 'required' => false])
            ->add('situation', TextType::class, ['label' => 'Situation', 'required' => false, 'attr' => ['placeholder' => 'Situation']])
            ->add('comment', TextType::class, ['label' => 'Commentaire', 'required' => false, 'attr' => ['placeholder' => 'Commentaire']])
            ->add('valider', SubmitType::class, ['label' => 'Valider', 'attr' => ['class' => 'btn btn-primary']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Vehicle::class,
        ]);
    }
}
