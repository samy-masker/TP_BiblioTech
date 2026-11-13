<?php

namespace App\Controller;

use App\Entity\Livre;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class LivreController extends AbstractController
{
    #[Route('/livre/{id}', name: 'app_livre')]
    public function index(Livre $livre): Response
    {
        return $this->render('livre/index.html.twig', [
            'livre' => $livre,
        ]);
    }
}