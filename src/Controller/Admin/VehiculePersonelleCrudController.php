<?php

namespace App\Controller\Admin;

use App\Entity\VehiculePersonelle;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ColorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class VehiculePersonelleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return VehiculePersonelle::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('personelle','Propriétaire du véhicule'),
            TextField::new('model','Model du véhicule exemple (Fiat Mickael)'),
            ColorField::new('couleur','Couleur du véhicule'),
            TextField::new('plate','Plaque du véhicule'),
            TextEditorField::new('commentaire','Description ou courte information'),
            ImageField::new('imageName', 'Photo de l\'employer')
            ->onlyOnIndex()
            ->setBasePath('/file/personelle/vehicles'),
            TextField::new('imageFile', 'Photo de l\'employer')
                ->onlyOnForms()
                ->setFormType(VichImageType::class),
        ];
    }
    
}
