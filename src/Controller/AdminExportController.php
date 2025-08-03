<?php
// src/Controller/AdminExportController.php

namespace App\Controller;

use App\Entity\Remorque;
use App\Repository\RemorqueRepository;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/export', name: 'app_export')]
class AdminExportController extends AbstractController
{
    public function exportToExcel(Request $request, RemorqueRepository $remrepo): Response
    {
        $entities = $remrepo->findAll();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Entêtes de colonne
        $columns = ['Colonne 1', 'Colonne 2', /* ... */];
        $columnIndex = 1;
        foreach ($columns as $column) {
            $sheet->setCellValueByColumnAndRow($columnIndex++, 1, $column);
        }

        // Données
        $rowIndex = 2;
        foreach ($entities as $entity) {
            $columnIndex = 1;
            // Remplir les données de chaque entité
            // Vous devrez ajuster cela en fonction de votre entité
            $sheet->setCellValueByColumnAndRow($columnIndex++, $rowIndex, $entity->getPropriete1());
            $sheet->setCellValueByColumnAndRow($columnIndex++, $rowIndex, $entity->getPropriete2());
            // Ajoutez d'autres colonnes si nécessaire...

            $rowIndex++;
        }

        // Créer un objet Writer et écrire le fichier Excel
        $writer = new Xlsx($spreadsheet);
        $tempFileName = tempnam(sys_get_temp_dir(), 'export_');
        $writer->save($tempFileName);

        // Envoi du fichier au navigateur
        return $this->file($tempFileName, 'export.xlsx', ResponseHeaderBag::DISPOSITION_ATTACHMENT);
    }
}
