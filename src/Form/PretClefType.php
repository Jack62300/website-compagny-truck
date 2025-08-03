<?php

namespace App\Form;

use App\Entity\PretClef;
use Symfony\Component\Form\AbstractType;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class PretClefType extends AbstractType
{
    public function __construct(Security $security)
    {
        $this->security = $security;
    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $currentUser = $this->security->getUser();
        $builder
            ->add('intituler', TextType::class)
            ->add('name', TextType::class)
            ->add('createdAt', DateTimeType::class)
            ->add('status', HiddenType::class,[
                'data' => 1
            ])
            ->add('agent',HiddenType::class, [
                'label' => 'Nom de L\'agent',
                'data' => $currentUser->getUsername()
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => PretClef::class,
        ]);
    }
}
