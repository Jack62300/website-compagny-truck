<?php

namespace App\Form;

use App\Entity\Adoucisseur;
use Symfony\Component\Form\AbstractType;
use Symfony\Bundle\SecurityBundle\Security;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class AdoucisseurType extends AbstractType
{
    public function __construct(Security $security)
    {
        $this->security = $security;
    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $currentUser = $this->security->getUser();
        $builder
            ->add('sacRestant', IntegerType::class,[
                'label' => 'Nombre de sac restant',
            ])
            ->add('sacUse', IntegerType::class,[
                'label' => 'Nombre de sac utiliser',
            ])
            ->add('agent',TextType::class, [
                'label' => 'Nom de L\'agent',
                'data' => $currentUser->getUsername()
            ])
            ->add('createdAt', DateTimeType::class)
            ->add('commentaire', TextareaType::class,[
                'label' => 'Information complémentaire',
            ])
        ;
    }

    public function configureCrud(Crud $crud): Crud
{
    return $crud
        // the visible title at the top of the page and the content of the <title> element
        // it can include these placeholders:
        //   %entity_name%, %entity_as_string%,
        //   %entity_id%, %entity_short_id%
        //   %entity_label_singular%, %entity_label_plural%
        ->setPageTitle('index', 'Contrôlle Adoucisseur P2')
    ;
}

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Adoucisseur::class,
        ]);
    }
}
