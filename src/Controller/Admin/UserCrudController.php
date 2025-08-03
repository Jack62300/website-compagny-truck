<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Dto\BatchActionDto;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function approveUsers(BatchActionDto $batchActionDto)
    {
        $entityManager = $this->container->get('doctrine')->getManagerForClass($batchActionDto->getEntityFqcn());
        foreach ($batchActionDto->getEntityIds() as $id) {
            $user = $entityManager->find($id);
            $user->approve();
        }

        $entityManager->flush();

        return $this->redirect($batchActionDto->getReferrerUrl());
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
        // ->setPermission(Action::DELETE, 'ROLE_ADMIN')
        // ->setPermission(Action::NEW, 'ROLE_ADMIN')
        // ->setPermission(Action::EDIT, 'ROLE_ADMIN')
        // ->setPermission(Action::DETAIL, 'ROLE_ADMIN')
            ->update(Crud::PAGE_INDEX, Action::NEW, function (Action $action) {
                return $action->setLabel('Ajouter un %entity_label_singular%');
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
                return $action->setLabel('Créer et ajouter un autre %entity_label_singular%');
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
        $role = ['ROLE_USER','ROLE_EDITOR','ROLE_ADMIN'];

        $password = TextField::new('password','Mot de passe')
            ->setFormType(PasswordType::class)
            ->setFormTypeOption('empty_data', '')
            ->setRequired(false)
            ->setHelp('Si le droit n\'est pas donné, laissez le champ vide.');
        $username = TextField::new('username','Nom D\'affichage');
        $email = EmailField::new('email','Adresse Email');
        $roles = ChoiceField::new('roles','Permission de l\'utilisateur')
        ->setChoices(array_combine($role, $role))
        ->allowMultipleChoices() 
        ->renderAsBadges();
        $verified = BooleanField::new('is_verified');

        switch ($pageName) {
            case Crud::PAGE_INDEX:
               return [
                    $username,
                    $email,
                    $roles,
                    $verified,
                ];
                break;
            case Crud::PAGE_DETAIL:
                return [
                    $username,
                    $email,
                    $roles,
                    $verified,
                ];
                break;
            case Crud::PAGE_NEW:
               return [
                $username,
                    $email,
                    $password,
                    $roles,
                    $verified,
                ];
                break;
            case Crud::PAGE_EDIT:
                return [
                    $username,
                    $email,
                    $password,
                    $roles,
                    $verified,
                ];
                break;
        }

    }
    
}
