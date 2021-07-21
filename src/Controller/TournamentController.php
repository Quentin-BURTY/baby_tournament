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
            'controller_name' => 'TournamentController',
            'tournament' => $tournamentRepository->findAll(),

        ]);
    }

    #[Route('/new', name: 'new')]
    public function new(Request $request): Response
    {
        $form = $this->createForm(TournamentType::class);
        $form->handleRequest($request);

        
        if ($form->isSubmitted() && $form->isValid()) {
            $tournament = new Tournament();
            
            $tournament->setName($request->request->get('tournament')['name']);
            $tournament->setNbUser($request->request->get('tournament')['nbUser']);
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
}
