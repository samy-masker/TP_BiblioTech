<?php
namespace App\Controller;

use App\Repository\LivreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PopulairesController extends AbstractController
{
    #[Route('/populaires', name: 'app_populaires')]
    public function index(LivreRepository $repo): Response
    {
        $livres = $repo->findPlusEmpruntes(10);

        return $this->render('populaires/index.html.twig', [
            'livres' => $livres,
        ]);
    }
}