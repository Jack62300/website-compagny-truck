<?php

namespace App\Controller;


use App\Form\RegistreType;
use App\Repository\ProductRepository;
use App\Repository\RegistreRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\NumberInterneRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\ProductCategorieRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class RegistreController extends AbstractController
{
    #[Route('/registre', name: 'app_registre')]
    public function index(PaginatorInterface $paginator, ProductRepository $procesrepo, NumberInterneRepository $numberrepo, ProductCategorieRepository $procesCatrepo,  RegistreRepository $registreRepo,  Request $request, EntityManagerInterface $em): Response
    {
        $registre = $registreRepo->findAll();
        $numbers = $numberrepo->findBy([],['number' => 'DESC']);
        $proceduresCategorie = $procesCatrepo->findAll();
        $procedures = $procesrepo->findAll();
        $registres = $paginator->paginate(
            $registre, // Requête contenant les données à paginer (ici nos articles)
            $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
            10 // Nombre de résultats par page
        );

        dump($registres);

        $form = $this->createForm(RegistreType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $donnees = $form->getData();           
            $em->persist($donnees);
            $em->flush();
            $this->addFlash(
                'info',
                'Dépôt main courante enregistrer'
                );
            return $this->redirectToRoute('app_registre');
        }


        return $this->render('registre/index.html.twig', [
            'numbers' => $numbers,
            'procedures' => $procedures,
            'categories' => $proceduresCategorie,
            'registres' => $registres,
            'form' => $form->createView(),

        ]);
    }
}
