<?php

namespace App\Controller\Admin;

use App\Entity\Reservation;
use FM\ElfinderBundle\Form\Type\ElFinderType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ReservationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Reservation::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
        // ->setPermission(Action::DELETE, 'ROLE_ADMIN')
        // ->setPermission(Action::NEW, 'ROLE_USER')
        // ->setPermission(Action::EDIT, 'ROLE_USER')
        // ->setPermission(Action::DETAIL, 'ROLE_USER')
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
            TextField::new('compagnie','Nom de la Compagnie'),
            TextField::new('plate','Plaque du véhicule'),
            ChoiceField::new('frigo','Véhicule frigo ?')->setChoices([
                "Actif" => 1,
                "Inactif" => 0,
            ]),
            TextField::new('maxHeure','Date / Heure maximun pour partie ?'),
            ChoiceField::new('type','Type de réservation ?')->setChoices([
                "TRAVIS" => "TRAVIS",
                "SITE TWV" => "SITE TWV",
                "OTTRA" => "OTTRA",
                "STEROO" => "STEROO",
                "EMAIL COMPTE CLIENT" => "EMAIL COMPTE CLIENT",
                "EMAIL AUTRE" => "EMAIL AUTRE",
            ]),
            TextField::new('heureArrival','Date / Heure d\'arriver'),
            TextField::new('idTransaction','Identifiant de transaction'),
            ChoiceField::new('status','Status de la réservation ?')->setChoices([
                'RESERVER' => 0,
                'SUR LE PARK' => 1,
                'SORTIE' => 2,
                'ANNULER' => 3,
            ]),
        ];
    }
}
