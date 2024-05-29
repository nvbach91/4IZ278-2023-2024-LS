<?php

namespace App\Controller;

use App\Entity\FootballMatch;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[IsGranted('ROLE_USER')]
class MatchController extends AbstractController
{
    #[Route('/zapasy', name: 'app_matches')]
    public function zapasy(EntityManagerInterface $em): Response
    {
        $allMatches = $em->getRepository(FootballMatch::class)->findAll();


        return $this->render('match/index.html.twig', [
            "matches" => $allMatches,
        ]);
    }

    #[Route('/zapasy/zapas/{slug}', name: 'app_match')]
    public function zapas(string $slug): Response
    {


        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }
}
