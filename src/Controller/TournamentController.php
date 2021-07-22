<?php

namespace App\Controller;

use App\Entity\Tournament;
use App\Form\TournamentType;
use App\Repository\TournamentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/tournament', name: 'tournament_')]
class TournamentController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(TournamentRepository $tournamentRepository): Response
    {
        return $this->render('tournament/index.html.twig', [
            'tournament' => $tournamentRepository->findAll(),

        ]);
    }

    #[Route('/new', name: 'new')]
    public function new(Request $request): Response
    {
        $tournament = new Tournament();
        $form = $this->createForm(TournamentType::class , $tournament);
        $form->handleRequest($request);

        
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($tournament);
            $entityManager->flush();
            return $this->redirectToRoute('tournament_index');

        }
        return $this->render('tournament/new.html.twig', [
            'form' => $form->createView(),
        ]);

    }

    #[Route('/{id}/delete', name: 'delete')]
    public function delete(Tournament $tournament): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($tournament);
        $entityManager->flush();
        return $this->redirectToRoute('tournament_index');
    }

    #[Route('/{id}/show', name: 'show')]
    public function show(Tournament $tournament): Response
    {
        return $this->render('tournament/show.html.twig', [
            'tournaments' => $tournament,
            'users' => $tournament->getUsers(),

        ]);
    }
}
