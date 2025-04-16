<?php

namespace App\Form;

use App\Entity\Vehicle;
use Doctrine\DBAL\Types\BooleanType;
use Symfony\Bridge\PhpUnit\ClassExistsMock;
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
            ->add('marque', TextType::class, ['label' => 'Marque', 'attr' => ['placeholder' => 'Marque'], 'required' => true])
            ->add('immat', TextType::class, ['label' => 'Immatriculation', 'attr' => ['placeholder' => 'Immatriculation'], 'required' => true])
            ->add('modele', TextType::class, ['label' => 'Modèle', 'attr' => ['placeholder' => 'Modèle'], 'required' => true])
            ->add('dateAcquisition', DateType::class, ['label' => 'Date d\'acquisition', 'widget' => 'single_text','required' => false])
            ->add('attribution', TextType::class, ['label' => 'Attribution', 'attr' => ['placeholder' => 'Attribution'], 'required' => false])
            ->add('numeroPlace', TextType::class, ['label' => 'Numero de place', 'attr' => ['placeholder' => 'Numero de place']])
            ->add('equipementPolice', CheckboxType::class, ['label' => 'Equipement de police', 'required' => false,])
            ->add('pret', CheckboxType::class, ['label' => 'Disponible pour prêt', 'required' => false,])
            ->add('situation', TextType::class, ['label' => 'Situation', 'required' => false, 'attr' => ['placeholder' => 'Situation']])
            ->add('dateCT', DateType::class, ['label' => 'Date de CT', 'widget' => 'single_text','required' => false])
            ->add('comment', TextType::class, ['label' => 'Commentaire', 'required' => false, 'attr' => ['placeholder' => 'Commentaire']])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Vehicle::class,
        ]);
    }
}
