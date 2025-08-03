<?php

namespace App\Controller;

use DateTime;
use Dompdf\Dompdf;
use Dompdf\Options;
use Knp\Snappy\Pdf;
use App\Form\GasType;
use App\Entity\Consigne;
use App\Entity\PretClef;
use App\Entity\Remorque;
use App\Form\LesiveType;
use App\Form\PretClefType;
use App\Form\RemorqueType;
use App\Form\AdoucisseurType;
use App\Repository\GasRepository;
use App\Repository\LesiveRepository;
use App\Repository\ProductRepository;
use App\Repository\ConsigneRepository;
use App\Repository\PretClefRepository;
use App\Repository\RemorqueRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\AdoucisseurRepository;
use App\Repository\ProductImageRepository;
use App\Repository\NumberInterneRepository;
use App\Repository\PersonelleRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\ProductCategorieRepository;
use App\Repository\VehiculePersonelleRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


/**
     * @Security("is_granted('ROLE_USER') and is_granted('ROLE_EDITOR') and is_granted('ROLE_ADMIN') and is_granted('ROLE_DEV')")
     */
class HomeController extends AbstractController
{

    private function calculateTimeAndPrice(Remorque $remorque)
    {
        // Récupérer la date d'entrée de la remorque
        $dateEnter = $remorque->getDateEnter();
    
        // Calculer le temps passé en minutes jusqu'à présent
        $now = new \DateTime();
        $interval = $now->diff($dateEnter);
        $tempsPasserEnMinutes = $interval->days * 24 * 60 + $interval->h * 60 + $interval->i;
    
        // Calculer le nombre de jours et d'heures
        $jours = floor($tempsPasserEnMinutes / (24 * 60));
        $heures = floor(($tempsPasserEnMinutes - ($jours * 24 * 60)) / 60);
    
        // Calculer le prix en fonction du temps passé
        $totalPrice = 0;
    
        if ($jours >= 2) {
            $totalPrice = $jours * 66; // 2 Jours = 66€
        } else {
            if ($jours == 1 && $heures == 0) {
                $totalPrice = 45; // 1 Jour et 0 minutes = 45€
            } elseif ($jours == 1 && ($heures > 0 || $interval->i > 0)) {
                $totalPrice = 66; // 1 Jour et 1 minute ou plus = 66€
            } elseif ($heures >= 9 && $heures < 16) {
                $totalPrice = 39; // Entre 9h et 16h = 39€
            } elseif ($heures >= 16 || ($heures == 16 && $interval->i > 0)) {
                $totalPrice = 45; // 16h + 1 minute ou plus = 45€
            } elseif ($heures >= 4 && $heures < 9) {
                $totalPrice = 27; // Entre 4h et 9h = 27€
            } elseif ($heures == 9 && ($interval->i > 0)) {
                $totalPrice = 39; // 9h et 1 minute ou plus = 39€
            } elseif ($heures >= 2 && $heures < 4) {
                $totalPrice = 15; // Entre 2h et 4h = 15€
            } elseif ($heures == 4 && ($interval->i > 0)) {
                $totalPrice = 27; // 4h et 1 minute ou plus = 27€
            } elseif ($heures >= 0 && $heures < 2) {
                $totalPrice = 9; // Entre 0h et 2h = 9€
            } elseif ($heures == 2 && ($interval->i > 0)) {
                $totalPrice = 15; // 2h et 1 minute ou plus = 15€
            }
        }
    
        return ['tempsPasser' => $tempsPasserEnMinutes, 'prix' => $totalPrice];
    }


    #[Route('/home', name: 'app_home')]
    public function home(PaginatorInterface $paginator, LesiveRepository $lesiveRepo, ProductRepository $procesrepo, ProductCategorieRepository $procesCatrepo, ConsigneRepository $consigne, PretClefRepository $clef, Request $request, EntityManagerInterface $em, GasRepository $gasrepo, AdoucisseurRepository $adourepo, NumberInterneRepository $numberrepo, RemorqueRepository $remrepo): Response
    {
       
        $cons = $consigne->findBy([],['id' => 'DESC'],3);
        $key = $clef->findBy(['status' => '1'],['createdAt' => 'DESC'], 10);
        $gas = $gasrepo->findBy([],['createdAt' => 'DESC'], 10);
        $adoucisseur = $adourepo->findBy([],['createdAt' => 'DESC'], 10);
        $numbers = $numberrepo->findBy([],['number' => 'DESC']);
        $remorque = $remrepo->findBy(['status' => 1],['status' => 'DESC']);
        $procedures = $procesrepo->findAll();
        $lesives = $lesiveRepo->findBy([],['id' => 'DESC'],10);
        $proceduresCategorie = $procesCatrepo->findAll();
        $remorques = $paginator->paginate(
            $remorque, // Requête contenant les données à paginer (ici nos articles)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            5 // Nombre de résultats par page
        );
        // $remor = $remrepo->findAll();
        // $results = [];

        // // Parcourir chaque remorque
        // foreach ($remor as $remorq) {
        //     // Calculer le temps passé et le prix pour cette remorque
        //     $result = $this->calculateTimeAndPrice($remorq);

        //     // Stocker le résultat dans le tableau avec l'ID de la remorque comme clé
        //     $results[$remorq->getId()] = $result;
        // }
        // dump($results, $remor);

      
       
        

        $form = $this->createForm(PretClefType::class);
        $form2 = $this->createForm(GasType::class);
        $form3 = $this->createForm(AdoucisseurType::class);
        $form4 = $this->createForm(RemorqueType::class);
        $form5 = $this->createForm(LesiveType::class);

        // Gère la soumission du formulaire si le formulaire a été soumis
        $form->handleRequest($request);
        $form2->handleRequest($request);
        $form3->handleRequest($request);
        $form4->handleRequest($request);
        $form5->handleRequest($request);
        
        // Vérifie si le formulaire est soumis et valide
        if ($form->isSubmitted() && $form->isValid()) {
            $donnees = $form->getData();           
            $em->persist($donnees);
            $em->flush();
            $this->addFlash(
                'info',
                'Prêt de clef Enregistré'
                );
            return $this->redirectToRoute('app_home');
        }

        if ($form2->isSubmitted() && $form2->isValid()) {
            $donnees = $form2->getData();           
            $em->persist($donnees);
            $em->flush();
            $this->addFlash(
                'info',
                'Niveau de Gas enregistré'
                );
            return $this->redirectToRoute('app_home');
            
        }
        if ($form3->isSubmitted() && $form3->isValid()) {
            $donnees = $form3->getData();
                      
            $em->persist($donnees);
            $em->flush();
            $this->addFlash(
                'info',
                'Contrôlle Adoucisseur enregistré'
                );
            return $this->redirectToRoute('app_home');
        }
        if ($form4->isSubmitted() && $form4->isValid()) {
            $donnees = $form4->getData();           
            $em->persist($donnees);
            $em->flush();
            $this->addFlash(
                'info',
                'Remorque enregistré'
                );
            return $this->redirectToRoute('app_home');
        }
        if ($form5->isSubmitted() && $form5->isValid()) {
            $donnees = $form5->getData();           
            $em->persist($donnees);
            $em->flush();
            $this->addFlash(
                'info',
                'Contrôlle lesive P1 enregistrer'
                );
            return $this->redirectToRoute('app_home');
        }

       

        // Construire et envoyer la notification
        
        

        // Autres actions...
   





        return $this->render('home/index.html.twig', [
            'consignes' => $cons,
            'procedures' => $procedures,
            'categories' => $proceduresCategorie,
            'keys' => $key,
            'form' => $form->createView(),
            'form2' => $form2->createView(),
            'form3' => $form3->createView(),
            'form4' => $form4->createView(),
            'form5' => $form5->createView(),
            'gass' => $gas,
            'adous' => $adoucisseur,
            'numbers' => $numbers,
            'remorques' => $remorques,
            'lesives' => $lesives,
            // 'results' => $results, 
        ]);
    }
    #[Route('/action_edit/{id}', name: 'app_remedit')]
    // #[Security("is_granted('ROLE_ADMIN') and is_granted('ROLE_USER')")]
    public function editRemorque($id, RemorqueRepository $remrepo, EntityManagerInterface $em, Security $security): Response
    {

        $user = $security->getUser();

        if ($user) {
            $username = $user->getUsername();
        }
        $remorque = $remrepo->find($id);
        $donnees = $remorque->setStatus(0);
        $donnees = $remorque->setAgent($username);
        $em->persist($donnees);
        $em->flush();
        $this->addFlash(
            'info',
            'Remorque Mise à jour'
            );
        return $this->redirectToRoute('app_home');
       
    }
    #[Route('/action_edit_key/{id}', name: 'app_keyedit')]
    // #[Security("is_granted('ROLE_ADMIN') and is_granted('ROLE_USER')")]
    public function editKey($id, PretClefRepository $keyRepo, EntityManagerInterface $em, Security $security): Response
    {

        $user = $security->getUser();

        if ($user) {
            $username = $user->getUsername();
        }
        $key = $keyRepo->find($id);
        $donnees = $key->setStatus(0);
        $donnees = $key->setAgent($username);
        $em->persist($donnees);
        $em->flush();
        $this->addFlash(
            'info',
            'Clef restitué'
            );
        return $this->redirectToRoute('app_home');
       
    }

    #[Route('/', name: 'app_index')]
    // #[Security("is_granted('ROLE_ADMIN') and is_granted('ROLE_USER')")]
    public function index(): Response
    {
        return $this->redirectToRoute('app_home');
    }

    #[Route('/procedure/{id}', name: 'app_procedure_view')]
    // #[Security("is_granted('ROLE_ADMIN') and is_granted('ROLE_USER')")]
    public function procedureView($id, ProductRepository $procesrepo, ProductCategorieRepository $procesCatrepo, ProductImageRepository $procesImgrepo, NumberInterneRepository $numberrepo): Response
    {
        $product = $procesrepo->find($id);
        $numbers = $numberrepo->findBy([],['number' => 'DESC']);
        $proceduresCategorie = $procesCatrepo->findAll();
        $procedures = $procesrepo->findAll();
        $proceduresImg = $procesImgrepo->findBy(['product' => $id]);
        return $this->render('home/procedure.html.twig', [
            'procedure'=> $product,
            'procedures' => $procedures,
            'images' => $proceduresImg,
            'numbers' => $numbers,
            'categories' => $proceduresCategorie,
           
        ]);
    }

    #[Route('/listePersonelles', name: 'app_personelle_view')]
    // #[Security("is_granted('ROLE_ADMIN') and is_granted('ROLE_USER')")]
    public function personelleView(PersonelleRepository $persoRepo, ProductRepository $procesrepo, VehiculePersonelleRepository $vehicleRepo, ProductCategorieRepository $procesCatrepo, ProductImageRepository $procesImgrepo, NumberInterneRepository $numberrepo): Response
    {
      
        $numbers = $numberrepo->findBy([],['number' => 'DESC']);
        $proceduresCategorie = $procesCatrepo->findAll();
        $procedures = $procesrepo->findAll();
        $personels = $persoRepo->findAll();
        $vehicles = $vehicleRepo->findAll();

        return $this->render('home/personelles.html.twig', [
            'personelles' => $personels,
            'procedures' => $procedures,
            'numbers' => $numbers,
            'categories' => $proceduresCategorie,
            'vehicles' => $vehicles,
           
        ]);
    }

}
