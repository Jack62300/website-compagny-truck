<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use App\Repository\ConsigneRepository;
use App\Repository\NumberInterneRepository;
use App\Repository\ProductCategorieRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ConsigneController extends AbstractController
{
    #[Route('/consigne', name: 'app_consigne')]
    public function index(ConsigneRepository $consigne, ProductRepository $procesrepo, ProductCategorieRepository $procesCatrepo, NumberInterneRepository $numberrepo): Response
    {
        $cons = $consigne->findBy( [], ['id' => 'DESC']);
        $numbers = $numberrepo->findBy([],['number' => 'DESC']);
        $procedures = $procesrepo->findAll();
        $proceduresCategorie = $procesCatrepo->findAll();
        return $this->render('consigne/index.html.twig', [
            'consignes' => $cons,
            'numbers' => $numbers,
            'procedures' => $procedures,
            'categories' => $proceduresCategorie,
        ]);
    }
}
