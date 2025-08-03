<?php

namespace App\Controller\Admin;

use App\Entity\NumberInterne;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class NumberInterneCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return NumberInterne::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name','Nom de la personne'),
            IntegerField::new('number','Numéro du poste'),
            TextField::new('role','Qualité de la personne (RH, PARK, direction)'),
        ];
    }

   public function configureCrud(Crud $crud): Crud
    {
        return $crud
            // ...
            ->setHelp(Crud::PAGE_INDEX, 'Liste des numéros interne de TWV')
            ->setPageTitle('index', 'Numéro interne de TWV')
            ->setEntityLabelInSingular('Numéro interne')
        ;
    }
}
