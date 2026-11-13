<?php

namespace App\Controller;

use App\Repository\LivreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CatalogueController extends AbstractController
{
    #[Route('/', name: 'app_catalogue')]
    public function index(LivreRepository $repo, Request $request): Response
    {
        $genre  = $request->query->get('genre');
        $auteur = $request->query->get('auteur');
        $tri    = $request->query->get('tri');

        $livres  = $repo->findCatalogue($genre, $auteur, $tri);
        $genres  = $repo->findGenres();
        $auteurs = $repo->findAuteurs();

        return $this->render('catalogue/index.html.twig', [
            'livres'  => $livres,
            'genres'  => $genres,
            'auteurs' => $auteurs,
            'filtres' => ['genre' => $genre, 'auteur' => $auteur, 'tri' => $tri],
        ]);
    }
}