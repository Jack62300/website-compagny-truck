<?php

namespace App\Controller\Admin;

use App\Entity\Gas;
use App\Entity\User;
use App\Entity\Lesive;
use App\Entity\Product;
use App\Entity\Consigne;
use App\Entity\PretClef;
use App\Entity\Registre;
use App\Entity\Remorque;
use App\Entity\Procedure;
use App\Entity\Personelle;
use App\Entity\Adoucisseur;
use App\Entity\Reservation;
use App\Entity\ProductImage;
use App\Entity\NumberInterne;
use App\Entity\ProcedureType;
use App\Entity\RegistreStatus;
use App\Entity\ProductCategorie;
use App\Entity\RegistreCategory;
use Symfony\UX\Chartjs\Model\Chart;
use App\Repository\PretClefRepository;
use Symfony\Bundle\SecurityBundle\Security;
use App\Controller\Admin\UserCrudController;
use App\Entity\VehiculePersonelle;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\UserMenu;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

/**
 * @Security("is_granted('ROLE_USER') and is_granted('ROLE_EDITOR') and is_granted('ROLE_ADMIN') and is_granted('ROLE_DEV')")
 */
class DashboardController extends AbstractDashboardController
{
    public function __construct(PretClefRepository $PretClefRepository,)
    {
        // $this->UserRepository = $UserRepository;
        $this->PretClefRepository = $PretClefRepository;
       
    }


    #[Route('/twvadmin', name: 'admin')]
    public function index(): Response
    {
        $clef = $this->PretClefRepository->findBy([],['status' => "DESC"] , 10, null);

        return $this->render('admin/my_dashboard.html.twig', [
            'clefs' => $clef
        ]);
    }

    public function configureAssets(): Assets
    {
        return Assets::new()->addCssFile('http//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css')
        ->addCssFile('css/admin.css')
        ->addJsFile('/assets/bundles/fosckeditor/ckeditor-9c3c83e4727d2a44f39f4785afa2c629.js')
        ;
    }



    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            // the name visible to end users
            // you can include HTML contents too (e.g. to link to an image)
            ->setTitle('<img class="logotop" src="http://twv.intensityrp.fr/img/twvlogo.png">')
            ->setTextDirection('ltr')
            ->renderContentMaximized()

            // by default EasyAdmin displays a black square as its default favicon;
            // use this method to display a custom favicon: the given path is passed
            // "as is" to the Twig asset() function:
            // <link rel="shortcut icon" href="{{ asset('...') }}">
            ->setFaviconPath('favicon.svg')

            // the domain used by default is 'messages'

        ;
    }




    public function configureUserMenu(UserInterface $user): UserMenu
    {
        // Usually it's better to call the parent method because that gives you a
        // user menu with some menu items already created ("sign out", "exit impersonation", etc.)
        // if you prefer to create the user menu from scratch, use: return UserMenu::new()->...
        return parent::configureUserMenu($user)
            // use the given $user object to get the user name
            // ->setName($user->getName())
            // use this method if you don't want to display the name of the user
            ->displayUserName(true)


            // use this method if you don't want to display the user image
            ->displayUserAvatar(true);
        // you can also pass an email address to use gravatar's service

        // you can use any type of menu item, except submenus

    }

    public function configureMenuItems(): iterable
    {
        return [
            MenuItem::section('Lien Utile','fa-solid fa-sitemap'),
            MenuItem::linkToDashboard('Accueil Dashboard', 'fa fa-home'),
            MenuItem::linktoRoute('Retour au site', 'fas fa-rotate-left', 'app_home')->setLinkTarget("_blank"),
            MenuItem::linktoUrl('Voir les Icones', 'fa-solid fa-icons', 'https://fontawesome.com/search?o=r&m=free')->setLinkTarget("_blank"),

            MenuItem::section('Administration','fa-solid fa-sitemap'),
            MenuItem::linkToCrud('Utilisateurs', 'fa fa-user', User::class),

            MenuItem::section('Gestion Park','fa-solid fa-sitemap'),
            MenuItem::linkToCrud('Prêt de Clef', 'fa fa-key', PretClef::class),
            MenuItem::linkToCrud('Consignes', 'fa fa-clipboard', Consigne::class),
            MenuItem::linkToCrud('Contrôlle Gas', 'fa fa-gas-pump', Gas::class),
            MenuItem::linkToCrud('Contrôlle Adoucisseur', 'fa fa-shower', Adoucisseur::class),
            MenuItem::linkToCrud('Contrôlle Lèsive', 'fa-solid fa-jug-detergent', Lesive::class),


            MenuItem::section('Sécurité','fa-solid fa-sitemap'),
            MenuItem::linkToCrud('Registre du personelle', 'fa fa-user', Personelle::class),
            MenuItem::linkToCrud('Véhicule du personnelle', 'fa fa-car', VehiculePersonelle::class),
            // MenuItem::linkToCrud('Registre de sécurité', 'fa-solid fa-handcuffs', Registre::class),
            // MenuItem::linkToCrud('Status du registre', 'fa-solid fa-chart-simple', RegistreStatus::class),

            MenuItem::section('Exploitation','fa-solid fa-sitemap'),
            MenuItem::linkToCrud('Remorque déconnecter', 'fa-solid fa-plug-circle-xmark', Remorque::class),
            MenuItem::linkToCrud('Réservation', 'fa fa-bookmark', Reservation::class),


            MenuItem::section('Gestion du Personelles','fa-solid fa-sitemap'),
            MenuItem::linkToCrud('Numéro Interne', 'fa-solid fa-square-phone-flip', NumberInterne::class),

            MenuItem::section('Procédure','fa-solid fa-sitemap'),
            MenuItem::linkToCrud('Toute les procédures', 'fa-solid fa-file-invoice', Product::class),
            MenuItem::linkToCrud('Images des procédures', 'fa-solid fa-images', ProductImage::class),
            MenuItem::linkToCrud('Catégorie procédures', 'fa-solid fa-file-invoice', ProductCategorie::class),
        ];
    }
}
