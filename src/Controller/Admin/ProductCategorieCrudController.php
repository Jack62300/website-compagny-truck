<?php

namespace App\Controller\Admin;

use App\Entity\ProductCategorie;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ProductCategorieCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ProductCategorie::class;
    }

    public function configureFields(string $pageName): iterable
    {
           yield TextField::new('name', 'Nom de la catégorie');
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            // ...
            ->setHelp(Crud::PAGE_INDEX, 'Avant de crée votre procédure, assuré vous que la catégorie est présente ici')
            ->setPageTitle('index', 'Catégorie procédures')
            ->setEntityPermission('ROLE_EDITOR')
        ;
    }

}
