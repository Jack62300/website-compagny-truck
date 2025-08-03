<?php

namespace App\Controller;

use App\Form\ReservationType;
use App\Repository\ProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\ReservationRepository;
use App\Repository\NumberInterneRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\ProductCategorieRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ReservationController extends AbstractController
{
    #[Route('/reservation', name: 'app_reservation')]
    public function index(PaginatorInterface $paginator, ReservationRepository $resa, ProductRepository $procesrepo, ProductCategorieRepository $procesCatrepo, Request $request, EntityManagerInterface $em, NumberInterneRepository $numberrepo): Response
    {
        $numbers = $numberrepo->findBy([],['number' => 'DESC']);
        $reservation = $resa->findBy([],['status' => 'ASC']); // 0 doit venir , 1 sur le park , 2 sortie
        $procedures = $procesrepo->findAll();
        $proceduresCategorie = $procesCatrepo->findAll();
      

        $resasite = $paginator->paginate(
            $reservation, // Requête contenant les données à paginer (ici nos articles)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            10 // Nombre de résultats par page
        );

        $form = $this->createForm(ReservationType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $donnees = $form->getData();           
            $em->persist($donnees);
            $em->flush();
            $this->addFlash(
                'info',
                'Reservation enregistrer'
                );
            return $this->redirectToRoute('app_reservation');
        }


        return $this->render('reservation/index.html.twig', [
            'reservations' => $resasite,
            'form' => $form->createView(),
            'numbers' => $numbers,
            'procedures' => $procedures,
            'categories' => $proceduresCategorie,
        ]);
    }
    #[Route('/update_status/{id}', name: 'app_status_edit')]
    // #[Security("is_granted('ROLE_ADMIN') and is_granted('ROLE_USER')")]
    public function editStatus($id, ReservationRepository $resarepo, Request $request, EntityManagerInterface $em, Security $security): Response
    {
        $status = $request->query->get('status');
        // $user = $security->getUser();

        // if ($user) {
        //     // Récupérer le nom d'utilisateur de l'utilisateur actuel
        //     $username = $user->getUsername();
            
        //     // Utiliser le nom d'utilisateur comme nécessaire
        //     // ...
        // }
        $reser = $resarepo->find($id);
        $donnees = $reser->setStatus($status);
        $em->persist($donnees);
        $em->flush();
        $this->addFlash(
            'info',
            'Reservation Mise à jour'
            );
        return $this->redirectToRoute('app_reservation');
       
    }
}
