<?php

namespace App\Form;

use App\Entity\Reservation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('compagnie', TextType::class,[
                'label' => 'Nom de la compagnie',
            ])
            ->add('plate', TextType::class,[
                'label' => 'Plaque du véhicule attendu',
            ])
            ->add('frigo',ChoiceType::class, [
                'label' => 'Véhicule Frigo ?',
                'choices'  => [
                    'Oui' => 1,
                    'Non' => 0,
                ],
            ])
            ->add('maxHeure', TextType::class,[
                'label' => 'Heure maximun de départ',
            ])
            ->add('type',ChoiceType::class, [
                'label' => 'Type de réservation',
                'choices'  => [
                    'Travis' => 'TRAVIS',
                    'Steroo' => 'STEROO',
                    'Site' => 'SITE TWV',
                    'Ottro' => 'OTTRO',
                    "EMAIL COMPTE CLIENT" => "EMAIL COMPTE CLIENT",
                    "EMAIL AUTRE" => "EMAIL AUTRE",
                ],
            ])
            ->add('heureArrival', TextType::class,
            [
                'label' => 'Heure d\'arrivée ',
            ])
            ->add('idTransaction',TextType::class,[
                'label' => 'Identifiant de transation travis ou autre (Mettre 0 si il y en à pas',
            ])
            ->add('status',ChoiceType::class, [
                'label' => 'Status de la réservation',
                'choices'  => [
                    'Reservé' => 0,
                    'Sur le park' => 1,
                    'Sortie' => 2,
                    'ANNULER' => 3,
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}
