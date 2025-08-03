<?php

namespace App\Controller\Admin;

use App\Entity\Adoucisseur;
use FM\ElfinderBundle\Form\Type\ElFinderType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class AdoucisseurCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Adoucisseur::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
        // ->setPermission(Action::DELETE, 'ROLE_EDITOR')
        // ->setPermission(Action::NEW, 'ROLE_EDITOR')
        // ->setPermission(Action::EDIT, 'ROLE_EDITOR')
        // ->setPermission(Action::DETAIL, 'ROLE_EDITOR')
            ->update(Crud::PAGE_INDEX, Action::NEW, function (Action $action) {
                return $action->setLabel('Ajouter une %entity_label_singular%');
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
                return $action->setLabel('Créer et ajouter une autre %entity_label_singular%');
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

    public function configureFields(string $pageName): iterable
    {
        return [
            IntegerField::new('sacRestant','Nombre de sac restant'),
            IntegerField::new('sacUse','Nombre de sac utiliser'),
            DateTimeField::new('createdAt','Date de vérification'),
            TextField::new('agent','Nom de la personne qui contrôlle'),
            TextareaField::new('commentaire','Avez vous une information à passer en plus ?'),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            // ...
            ->setHelp(Crud::PAGE_INDEX, 'Chaque Contrôlle de l\'adoucisseur doit être indiqué ici')
            ->setPageTitle('index', 'Contrôlle adoucisseur P2')
        ;
    }

}
