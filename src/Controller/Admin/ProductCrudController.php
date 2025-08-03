<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use App\Form\ProductImagesType;
use Symfony\Bundle\SecurityBundle\Security;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ProductCrudController extends AbstractCrudController
{

    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    } 
    
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
        // ->setPermission(Action::DELETE, 'ROLE_EDITOR')
        // ->setPermission(Action::NEW, 'ROLE_EDITOR')
        // ->setPermission(Action::EDIT, 'ROLE_EDITOR')
        // ->setPermission(Action::DETAIL, 'ROLE_EDITOR')
            ->update(Crud::PAGE_INDEX, Action::NEW, function (Action $action) {
                return $action->setLabel('Ajouter une procédure');
            })
            ->update(Crud::PAGE_INDEX, Action::EDIT, function (Action $action) {
                return $action->setLabel('Modifier');
            })
            ->update(Crud::PAGE_INDEX, Action::DELETE, function (Action $action) {
                return $action->setLabel('Supprimer');
            })
            ->update(Crud::PAGE_NEW, Action::SAVE_AND_RETURN, function (Action $action) {
                return $action->setLabel('Créer');
            })
            ->update(Crud::PAGE_NEW, Action::SAVE_AND_ADD_ANOTHER, function (Action $action) {
                return $action->setLabel('Créer et ajouter une autre');
            })
            ->update(Crud::PAGE_EDIT, Action::SAVE_AND_RETURN, function (Action $action) {
                return $action->setLabel('Sauvegarder les changements');
            })
            ->update(Crud::PAGE_EDIT, Action::SAVE_AND_CONTINUE, function (Action $action) {
                return $action->setLabel('Sauvegarder et continuer à modifier');
            })
            ->update(Crud::PAGE_DETAIL, Action::DELETE, function (Action $action) {
                return $action->setLabel('Supprimer');
            })
            ->update(Crud::PAGE_DETAIL, Action::INDEX, function (Action $action) {
                return $action->setLabel('Retour à la liste');
            })
            ->update(Crud::PAGE_DETAIL, Action::EDIT, function (Action $action) {
                return $action->setLabel('Modifier');
            })
            ;
    }

    public function configurecrud(crud $crud): crud
    {
        return $crud->addformtheme('@FOSCKEditor/Form/ckeditor_widget.html.twig');
    }




    public function configureFields(string $pageName): iterable
    {
        $username = $this->getUser()->getUsername();
        yield IdField::new('id')
            ->onlyOnIndex();

        yield FormField::addTab('Information Général');
        yield TextField::new('name','Titre de la procédure')->hideOnIndex();
        yield TextField::new('title','Nom afficher dans le menu');
        yield DateTimeField::new('createdAt','Date de création');
        yield TextField::new('agent','Nom du créateur de la procédure')->setFormTypeOption('attr', ['value' => $username]);

        yield FormField::addTab('Contenue de la procédure');
        yield TextEditorField::new('notice','Information importante ( pas obligatoire)')->setNumOfRows(15)->hideOnIndex();
        yield TextEditorField::new('content','Contenue de votre procédure')->setNumOfRows(15)->hideOnIndex();

        yield FormField::addTab('Image/catégorie');
        yield CollectionField::new('images')->setEntryType(ProductImagesType::class)->hideOnIndex();
        yield AssociationField::new('categorie')->setFormTypeOption('choice_label', 'name')->setFormTypeOption('by_reference', true);
        
    }


}
