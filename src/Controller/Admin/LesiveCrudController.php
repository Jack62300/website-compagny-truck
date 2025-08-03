<?php

namespace App\Controller\Admin;

use App\Entity\Lesive;
use Symfony\Bundle\SecurityBundle\Security;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class LesiveCrudController extends AbstractCrudController
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }
    public static function getEntityFqcn(): string
    {
        return Lesive::class;
    }

    public function configureFields(string $pageName): iterable
    {
        $username = $this->getUser()->getUsername();
        return [
            IntegerField::new('stock','Nombre de bidon restant'),
            DateTimeField::new('createdAt','Date de vérification'),
            TextField::new('agent','Nom de l\'agent qui contrôlle')->setVirtual(true)->setEmptyData($username)->setFormTypeOption('attr', ['value' => $username, 'disabled' => true]),
        ];
    }
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            // ...
            ->setHelp(Crud::PAGE_INDEX, 'Contrôlle qui concerne la léssive du P1')
            ->setPageTitle('index', 'Contrôlle lessive P1')
        ;
    }
}
