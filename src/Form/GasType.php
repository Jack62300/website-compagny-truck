<?php

namespace App\Form;

use App\Entity\Gas;
use Symfony\Component\Form\AbstractType;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class GasType extends AbstractType
{
    public function __construct(Security $security)
    {
        $this->security = $security;
    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $currentUser = $this->security->getUser();
        $builder
            ->add('niveau',IntegerType::class,[
                'label' => 'Niveau de Gas restant',
            ])
            ->add('agent',HiddenType::class, [
                'label' => 'Nom de L\'agent',
                'data' => $currentUser->getUsername()
            ])
            ->add('createdAt', DateTimeType::class,[
                'label' => 'Date/Heure du Contrôlle',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Gas::class,
        ]);
    }
}
