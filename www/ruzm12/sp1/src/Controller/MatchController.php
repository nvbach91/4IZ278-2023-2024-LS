<?php

namespace App\Controller;

use App\Entity\Ticket;
use App\Entity\Entrance;
use App\Entity\FootballMatch;
use App\Form\PurchaseTicketsType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
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

    #[Route('/zapasy/zapas/{slug}', name: 'app_match_tickets')]
    public function zapas(string $slug, EntityManagerInterface $em, Request $request): Response
    {
        $match = $em->getRepository(FootballMatch::class)->findOneBy(['slug' => $slug]);

        if (!$match) {
            throw $this->createNotFoundException('Zápas nebyl nalezen');
        }

        if (!$match->isAvailability()) {
            throw $this->createNotFoundException('Zápas je již vzprodán');
        }

        $form = $this->createForm(PurchaseTicketsType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            dump($data);
            dump($form->get('numberOfAdultTickets')->getData());

            for ($i = 0; $i < $form->get('numberOfAdultTickets')->getData(); $i++) {
                $ticket = new Ticket();
                $ticket->setFootballMatch($match);
                $ticket->setSoldAt(new \DateTimeImmutable());
                $ticket->setMulti(false);
                $ticket->setEntrance($em->getRepository(Entrance::class)->findOneBy(['name' => 'Online']));
                $ticket->setOwner($this->getUser());
                $ticket->setType('adult');
                $ticket->setPrice($match->getFullPrice());
                $ticket->setConfirmed(false);
                $em->persist($ticket);
            }

            for ($i = 0; $i < $form->get('numberOfChildTickets')->getData(); $i++) {
                $ticket = new Ticket();
                $ticket->setFootballMatch($match);
                $ticket->setSoldAt(new \DateTimeImmutable());
                $ticket->setMulti(false);
                $ticket->setEntrance($em->getRepository(Entrance::class)->findOneBy(['name' => 'Online']));
                $ticket->setOwner($this->getUser());
                $ticket->setType('child');
                $ticket->setPrice($match->getChildPrice());
                $ticket->setConfirmed(false);
                $em->persist($ticket);
            }

            $em->flush();

            return $this->redirectToRoute('app_matches');
        }


        return $this->render('match/match.html.twig', [
            "match" => $match,
            "form" => $form->createView(),
        ]);
    }
}
