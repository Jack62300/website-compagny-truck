<?php

namespace App\Controller\Admin;

use DateTime;
use App\Entity\Registre;
use App\Form\RegistreImagesType;
use App\Form\Type\CustomDateType;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Option\SearchMode;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class RegistreCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Registre::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
        // ->setPermission(Action::DELETE, 'ROLE_EDITOR')
        // ->setPermission(Action::NEW, 'ROLE_EDITOR')
        // ->setPermission(Action::EDIT, 'ROLE_EDITOR')
        // ->setPermission(Action::DETAIL, 'ROLE_EDITOR')
            ->update(Crud::PAGE_INDEX, Action::NEW, function (Action $action) {
                return $action->setLabel('Ajouter un événement');
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

    
    public function configureFields(string $pageName): iterable
    {
        $username = $this->getUser()->getUsername();
        $datetime = new DateTime();
        return [
            TextField::new('intituler','Descriptif court'),
            DateTimeField::new('createdAt','Date et heure de l\'évenement'),
            ChoiceField::new('categorie','Type d\'événement')->setChoices([
                "INCENDIE" => "INCENDIE",
                "DEGRADATION" => "DEGRADATION",
                "CONTROLLE" => "CONTROLLE",
                "MIGRANT" => "MIGRANT",
                "INCIVILITER" => "INCIVILITER",
                "LITIGE" => "LITIGE",
                "FRAUDE" => "FRAUDE",
                "RONDE" => "RONDE",
                "BAGARRE" => "BAGARRE",
            ]),
            AssociationField::new('status','status de l\événement'),
            TextEditorField::new('content','Contenue de la main courante')->setNumOfRows(15),
            TextField::new('agent','Nom de l\'agent Intervenant')->setFormTypeOption('attr', ['value' => $username, 'disabled' => true]),
            CollectionField::new('images')->setEntryType(RegistreImagesType::class)->hideOnIndex(),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            // ...
            ->setHelp(Crud::PAGE_INDEX, 'Page restraint au personelle de sécurité, registre de sécurité privée')
            ->setPageTitle('index', 'Registre de sécurité')
            ->setDefaultSort([
                'status' => 'DESC',
            ])
            ->setEntityLabelInSingular('Evénement')
            ->setSearchMode(SearchMode::ALL_TERMS)
        ;
    }

    
}
