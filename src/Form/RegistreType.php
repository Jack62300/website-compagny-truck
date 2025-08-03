<?php

namespace App\Form;

use App\Entity\Registre;
use App\Entity\RegistreImage;
use App\Entity\RegistreCategory;
use App\Form\RegistreImagesType;
use Symfony\Component\Form\AbstractType;
use Symfony\Bundle\SecurityBundle\Security;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class RegistreType extends AbstractType
{
    public function __construct(Security $security)
    {
        $this->security = $security;
    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $currentUser = $this->security->getUser();
        $builder
            ->add('intituler', TextType::class,[
                'label' => 'Intitulé court de l\'évenement',
            ])
            ->add('createdAt', DateTimeType::class,[
                'label' => 'Date et Heure de l\'évènement ',
            ])
            ->add('status', ChoiceType::class,[
                'label' => 'Status de L\'événement',
                'choices'  => [
                    "EN COURT" => "EN COURS",
                    "SITUATION MAITRISER" => "SITUATION MAITRISER",
                    "TERMINER" => "TERMINER",
                    "AUTRE" => "AUTRE",
                ],
            ]
            )
            ->add('categorie', EntityType::class, array(
                'class'     => RegistreCategory::class,
                'expanded'  => false,
                'multiple'  => false,
            ))
            ->add('content', CKEditorType::class,[
                'label' => 'Rapport D\'événement',
            ])
            ->add('agent', HiddenType::class, [
                'data' => $currentUser->getUsername()
            ])
            ->add('images', CollectionType::class, [
                'entry_type' => RegistreImagesType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'required' => false,
                'label'=>'Insérais votre/vos images ici',
                'by_reference' => false,
                'disabled' => false,
            ])        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Registre::class,
        ]);
    }
}
