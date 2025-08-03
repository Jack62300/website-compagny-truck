<?php

namespace App\Controller\Admin;

use App\Entity\Consigne;
use App\Field\VichImageField;
use Symfony\Bundle\SecurityBundle\Security;
use FM\ElfinderBundle\Form\Type\ElFinderType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Vich\UploaderBundle\Form\Type\VichFileType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Form\Type\FileUploadType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ConsigneCrudController extends AbstractCrudController
{

    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }
    
    public static function getEntityFqcn(): string
    {
        return Consigne::class;
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
        $user = $this->security->getUser();
        return [
            TextField::new('name','Nom du créateur de la consigne ou demandeur'),
            TextField::new('title','Titre de la consigne'),
            DateTimeField::new('createdAt','Date de Création'),
            TextEditorField::new('content','Contenue de votre consigne')->setNumOfRows(15)->hideOnIndex(),
            ChoiceField::new('status','Status de la consigne ?')->setChoices([
                "Actif" => 1,
                "Inactif" => 0,
            ]),
            Field::new('pieceJointe', 'Image ou Piéce jointe')
            ->setFormType(ElFinderType::class)
            ->setFormTypeOptions([
                'instance' => 'form',
                'enable' => true,
            ])
            ->onlyOnForms()
        ];
    }

    public function configureCrud(Crud $crud): Crud
{
    return $crud
        // ...
        ->addFormTheme('@FOSCKEditor/Form/ckeditor_widget.html.twig')
        ->addFormTheme('@FMElfinder/Form/elfinder_widget.html.twig')
        ->setHelp(Crud::PAGE_INDEX, 'Ajouté des consignes ici, il serons visible ou pas selon votre choix sur la page d\'accceuil')
        ->setPageTitle('index', 'Liste des consignes')
    ;
}
    
}
