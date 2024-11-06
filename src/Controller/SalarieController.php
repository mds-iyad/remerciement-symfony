<?php

namespace App\Controller;

use App\Repository\SalarieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SalarieController extends AbstractController
{
    #[Route('/salaries', name: 'Salarie_index')]
    public function index(SalarieRepository $SalarieRepository): Response
    {
        $Salaries = $SalarieRepository->findAll();

        return $this->render('Salarie/index.html.twig', [
            'Salaries' => $Salaries,
        ]);
    }
}
