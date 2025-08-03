<?php

namespace App\Controller\Admin;

use App\Entity\Remorque;
use App\Repository\RemorqueRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Response;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\HiddenField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class RemorqueCrudController extends AbstractCrudController
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }
    public const ACTION_SAVE_CSV = "<i class=\"fa-solid fa-file-csv\"></i>Exporter en CSV";
    public static function getEntityFqcn(): string
    {
        return Remorque::class;
    }

    public function configureActions(Actions $actions): Actions
    {

        $duplicate = Action::new(self::ACTION_SAVE_CSV)
            ->linkToCrudAction('saveUsersToCsv')
            ->setCssClass('btn btn-primary')
            ->createAsGlobalAction();
        
        return $actions
            ->update(Crud::PAGE_INDEX, Action::NEW, function (Action $action) {
                return $action->setLabel('📝 Ajouter une %entity_label_singular%');
            })
            ->update(Crud::PAGE_INDEX, Action::EDIT, function (Action $action) {
                return $action->setLabel('🖊 Modifier');
            })
            ->update(Crud::PAGE_INDEX, Action::DELETE, function (Action $action) {
                return $action->setLabel('🗑 Supprimer');
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
                return $action->setLabel('🗑 Supprimer');
            })
            ->update(Crud::PAGE_DETAIL, Action::INDEX, function (Action $action) {
                return $action->setLabel('Retour à la liste');
            })
            ->update(Crud::PAGE_DETAIL, Action::EDIT, function (Action $action) {
                return $action->setLabel('Modifier');
            })
            ->add(Crud::PAGE_INDEX,$duplicate)
            ;
    }

    public function saveUsersToCsv(
        AdminContext $context,
        AdminUrlGenerator $adminUrlGenerator,
        RemorqueRepository $remRepo
    ): Response {

        $remorques= $remRepo->findAll(); // Doctrine query
        $rows = [
            ['id', 'compagnie', 'plate', 'date_enter', 'calle', 'agent', 'status'],
        ];
        
      
        foreach($remorques as $remorque){
            if ($remorque->getCalle() == 0){
                $calle = "Oui";
            }
            else{
                $calle = "Non";
            }

            if ($remorque->isStatus() == 0){
                $status = "SUR LE PARK";
            }
            else{
                $status = "SORTIE";
            }
            $dateEnterString = $remorque->getDateEnter()->format('d-m-Y H:i:s');

            $data = array(
                $remorque->getId(),
                $remorque->getCompagnie(),
                $remorque->getPlate(),
                $dateEnterString,
                $calle,
                $remorque->getAgent(),
                $status,
            );
            $rows[] = $data;
        }
        $response = new Response();
        $handle = fopen('php://output', 'w');
    
        // Configuration du séparateur de champ
        $delimiter = ',';
        $enclosure = '"';

        // Écriture des lignes dans le fichier CSV
        foreach ($rows as $row) {
            fputcsv($handle, $row, $delimiter, $enclosure);
        }
       
    
        fclose($handle);
        $response->headers->set("Content-Type",'text/csv');
        $response->headers->set("Content-Disposition",'attachment; filename="remorques.csv"');

        return $response;
    }



    public function configureFields(string $pageName): iterable
    {
        $username = $this->getUser()->getUsername();
        return [
            TextField::new('compagnie','Nom de la compagnie'),
            TextField::new('plate','Plaque de la remorque'),
            BooleanField::new('isFridge','Frigo ON ?'),
            DateTimeField::new('dateEnter','Date d\'entrer de la remorque'),
            ChoiceField::new('status','Remorque sur le park ou sortie ? ')->setChoices([
                "SUR LE PARK" => 1,
                "SORTIE" => 0,
            ]),
            ChoiceField::new('calle','Le camion à t\'ils des calles ? ')->setChoices([
                "OUI" => 1,
                "NON" => 0,
            ]),
           TextField::new('agent','Nom de l\'agent')->setFormTypeOption('attr', ['value' => $username]),
        ];
    }
}
