<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Ticket;
use App\Entity\Entrance;
use App\Entity\FootballMatch;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[IsGranted('ROLE_USER')]
class TicketController extends AbstractController
{
    #[Route('/moje-vstupenky', name: 'app_users_tickets')]
    public function index(EntityManagerInterface $em): Response
    {
        $tickets = $this->getUser()->getTickets();
        $matches = [];
        $result = [];


        foreach ($tickets as $ticket) {
            if (!in_array($ticket->getFootballMatch(), $matches)) {
                $matches[] = $em->getRepository(FootballMatch::class)->findOneBy(['id' => $ticket->getFootballMatch()]);
            }
        }

        foreach ($matches as $match) {
            $numberOfAdultTickets = 0;
            $numberOfChildTickets = 0;

            foreach ($tickets as $ticket) {
                if ($ticket->getFootballMatch() === $match) {
                    if ($ticket->getType() === 'adult') {
                        $numberOfAdultTickets++;
                    } else if ($ticket->getType() === 'child') {
                        $numberOfChildTickets++;
                    }
                }
            }

            $result[] = [
                'match' => $match,
                'matchDate' => $match->getPlayedAt(),
                'numberOfAdultTickets' => $numberOfAdultTickets,
                'numberOfChildTickets' => $numberOfChildTickets,
                'totalPrice' => $numberOfAdultTickets * $match->getFullPrice() + $numberOfChildTickets * $match->getChildPrice(),
            ];
        }


        return $this->render('ticket/tickets.html.twig', [
            'controller_name' => 'TicketController',
            'tickets' => $result,
        ]);
    }

    // #[Route('/moje-vstupenky/upravit/{slug}', name: 'app_edit_user_match')]
    // public function editUserMatchTickets(string $slug, EntityManagerInterface $em, Request $request): Response
    // {
    //     $tickets = $this->getUser()->getTickets();
    //     $match = $em->getRepository(FootballMatch::class)->findOneBy(['slug' => $slug]);

    //     $numberOfAdultTicketsOld = 0;
    //     $numberOfChildTicketsOld = 0;

    //     foreach ($tickets as $ticket) {
    //         if ($ticket->getFootballMatch() !== $match) {
    //             continue;
    //         }
    //         if ($ticket->getType() === "adult") {
    //             $numberOfAdultTicketsOld++;
    //         } else if ($ticket->getType() === "child") {
    //             $numberOfChildTicketsOld++;
    //         }
    //     }

    //     if ($request->isMethod('POST')) {
    //         $numberOfAdultTicketsNew = (int)$request->request->get('numberOfAdultTickets');
    //         $numberOfChildTicketsNew = (int)$request->request->get('numberOfChildTickets');

    //         if ($numberOfAdultTicketsNew < 0 || $numberOfChildTicketsNew < 0) {
    //             $this->addFlash('danger', 'Počet vstupenek nemůže být záporný');
    //             return $this->redirectToRoute('app_edit_user_match', ['slug' => $match->getSlug()]);
    //         }

    //         if ($numberOfAdultTicketsNew > 10 || $numberOfChildTicketsNew > 10) {
    //             $this->addFlash('danger', 'Nelze zakoupit více než 10 vstupenek jednoho typu');
    //             return $this->redirectToRoute('app_edit_user_match', ['slug' => $match->getSlug()]);
    //         }

    //         $adultDiff = $numberOfAdultTicketsOld - $numberOfAdultTicketsNew;
    //         $childDiff = $numberOfChildTicketsOld - $numberOfChildTicketsNew;

    //         if ($numberOfAdultTicketsNew < $numberOfAdultTicketsOld) {
    //             for ($i = 0; $i <= abs($numberOfAdultTicketsOld - $numberOfAdultTicketsNew); $i++) {
    //                 $ticket = $em->getRepository(Ticket::class)->findOneBy(['owner' => $this->getUser(), 'FootballMatch' => $match, 'type' => 'adult']);
    //                 $em->remove($ticket);
    //             }
    //         } else if ($numberOfAdultTicketsNew > $numberOfAdultTicketsOld) {
    //             for ($i = 0; $i < $adultDiff; $i++) {
    //                 $ticket = new Ticket();
    //                 $ticket->setFootballMatch($match);
    //                 $ticket->setSoldAt(new \DateTimeImmutable());
    //                 $ticket->setMulti(false);
    //                 $ticket->setEntrance($em->getRepository(Entrance::class)->findOneBy(['name' => 'Online']));
    //                 $ticket->setOwner($this->getUser());
    //                 $ticket->setType('adult');
    //                 $ticket->setPrice($match->getFullPrice());
    //                 $em->persist($ticket);
    //             }
    //         }

    //         if ($childDiff > 0) {
    //             for ($i = $numberOfChildTicketsOld; $i < $numberOfChildTicketsNew; $i++) {
    //                 $ticket = $em->getRepository(Ticket::class)->findOneBy(['owner' => $this->getUser(), 'FootballMatch' => $match, 'type' => 'child']);
    //                 $em->remove($ticket);
    //             }
    //         } else if ($childDiff < 0) {
    //             for ($i = $numberOfChildTicketsOld; $i < $numberOfChildTicketsNew; $i++) {
    //                 $ticket = new Ticket();
    //                 $ticket->setFootballMatch($match);
    //                 $ticket->setSoldAt(new \DateTimeImmutable());
    //                 $ticket->setMulti(false);
    //                 $ticket->setEntrance($em->getRepository(Entrance::class)->findOneBy(['name' => 'Online']));
    //                 $ticket->setOwner($this->getUser());
    //                 $ticket->setType('child');
    //                 $ticket->setPrice($match->getChildPrice());
    //                 $em->persist($ticket);
    //             }
    //         }

    //         $em->flush();

    //         return $this->redirectToRoute('app_users_tickets');
    //     }

    //     // dump((int)$request->request->get('numberOfAdultTickets'));


    //     // dump($numberOfAdultTickets);
    //     // dump($numberOfChildTickets);

    //     return $this->render('ticket/edit-tickets.html.twig', [
    //         'match' => $match,
    //         'numberOfAdultTickets' => $numberOfAdultTicketsOld,
    //         'numberOfChildTickets' => $numberOfChildTicketsOld,
    //     ]);
    // }
}
