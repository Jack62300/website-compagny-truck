<?php

namespace App\Form;

use App\Entity\Remorque;
use Symfony\Component\Form\AbstractType;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class RemorqueType extends AbstractType
{
    public function __construct(Security $security)
    {
        $this->security = $security;
    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $currentUser = $this->security->getUser();
        $builder
            ->add('compagnie', TextType::class,[
                'label' => 'Compagnie de la remorque',
            ])
            ->add('plate', TextType::class,[
                'label' => 'Plaque de la Remorque',
            ])
            ->add('dateEnter', DateTimeType::class,[
                'label' => 'Date d\'entrer de la remorque',
            ])
            ->add('tempsPasser',HiddenType::class,[
                'label' => 'Temps de la remorque sur le park',
                'data' => 0
            ])
            ->add('calle',ChoiceType::class, [
                'choices'  => [
                    'Oui' => 1,
                    'Non' => 0,
                ],
            ])
            ->add('isFridge', CheckboxType::class,[
                'label' => 'Frigo ON ?',
                'required' => false,
            ])
            ->add('agent',HiddenType::class, [
                'label' => 'Nom de L\'agent',
                'data' => $currentUser->getUsername()
            ])
            ->add('status',HiddenType::class, [
                'label' => 'Status de la remorque',
                'data' => 1
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Remorque::class,
        ]);
    }
}
