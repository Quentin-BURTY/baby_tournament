<?php

namespace App\Controller;

use App\Entity\Games;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/games', name: 'games_')]
class GamesController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('games/index.html.twig', [
            'controller_name' => 'GamesController',
        ]);
    }

    #[Route('/new', name: 'new')]
    public function new(Request $request): Response
    {
        $games = new Games();
        
    }
}
