<?php

namespace App\Controller\Admin;

use App\Entity\Personelle;
use App\Field\VichImageField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Option\SearchMode;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class PersonelleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Personelle::class;
    }

    public function configureFields(string $pageName): iterable
    {

        return [
            ImageField::new('imageName', 'Photo de l\'employer')
                ->onlyOnIndex()
                ->setBasePath('/file/personelle'),
            TextField::new('imageFile', 'Photo de l\'employer')
                ->onlyOnForms()
                ->setFormType(VichImageType::class),
            TextField::new('nom', 'Nom de famille'),
            TextField::new('prenom', 'Prénom'),
            TextField::new('role', 'Poste occupé de la personne'),
            ChoiceField::new('secteur', 'Secteur de Travail')->setChoices([
                "PARK" => "PARK",
                "LOGISTIQUE" => "LOGISTIQUE",
                "DIRECTION" => "DIRECTION",
            ]),
            // AssociationField::new('vehicles','véhicule de la personne')
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            // ...
            ->setHelp(Crud::PAGE_INDEX, 'Page pour le registre du personelle')
            ->setPageTitle('index', 'Registre du personelle')
            ->setDefaultSort([
                'id' => 'DESC',
            ])
            ->setEntityLabelInSingular('Personelle')
            ->setSearchMode(SearchMode::ALL_TERMS);
    }
}
