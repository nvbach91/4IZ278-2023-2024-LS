<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Ticket;
use App\Form\EditUserType;
use App\Entity\FootballMatch;
use App\Form\CreateMatchFormType;
use App\Service\MatchSlugGenerator;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Constraints\All;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[IsGranted('ROLE_ADMIN')]
class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    #[Route('/admin-matches', name: 'app_admin_matches')]
    public function matches(EntityManagerInterface $em): Response
    {
        $allMatches = $em->getRepository(FootballMatch::class)->findAll();

        return $this->render('admin/matches.html.twig', [
            "matches" => $allMatches,
        ]);
    }

    #[Route('/admin-matches/create', name: 'app_admin_matches_create')]
    public function createMatch(EntityManagerInterface $em, Request $request, MatchSlugGenerator $slugGenerator): Response
    {
        $match = new FootballMatch();
        $form = $this->createForm(CreateMatchFormType::class, $match);
        $form->handleRequest($request);

        $status = "";

        if ($form->isSubmitted() && $form->isValid()) {
            $match->setCreatedBy($this->getUser());
            $match->setSlug($slugGenerator->generateSlug($match->getTitle(), $match->getPlayedAt()));
            dump($match->getSlug());
            $em->persist($match);

            if ($em->flush()) {
                $status = "error";
            } else {
                $status = "success";
                return $this->redirectToRoute('app_admin_matches');
            }
        }

        return $this->render('admin/match-create.html.twig', [
            "form" => $form->createView(),
            "status" => $status
        ]);
    }

    #[Route('/admin-matches/match/edit/{slug}', name: 'app_admin_match_edit')]
    public function editMatch(string $slug, EntityManagerInterface $em, Request $request): Response
    {
        $match = $em->getRepository(FootballMatch::class)->findOneBy(['slug' => $slug]);
        $form = $this->createForm(CreateMatchFormType::class, $match);
        $form->handleRequest($request);

        $status = "";

        if ($form->isSubmitted() && $form->isValid()) {
            $match->setCreatedBy($this->getUser());
            $em->persist($match);

            if ($em->flush()) {
                $status = "error";
            } else {
                $status = "success";
                return $this->redirectToRoute('app_admin_matches');
            }
        }

        return $this->render('admin/match-create.html.twig', [
            "form" => $form->createView(),
            "status" => $status
        ]);
    }

    #[Route('/admin-matches/match/register/{slug}', name: 'app_admin_match_register')]
    public function matchRegister(string $slug, EntityManagerInterface $em, Request $request): Response
    {
        $match = $em->getRepository(FootballMatch::class)->findOneBy(['slug' => $slug]);
        $errors = [];

        if (!$match) {
            throw $this->createNotFoundException('Zápas nebyl nalezen');
        }

        if ($request->isMethod('POST')) {
            $user = $em->getRepository(User::class)->findOneBy(['email' => $request->request->get('userEmail')]);

            if (!$user) {
                $errors[] = "Uživatel nebyl nalezen";

                return $this->render('admin/match-register.html.twig', [
                    "match" => $match,
                    "errors" => $errors
                ]);
            }

            $userMatchTickets = $em->getRepository(Ticket::class)->findBy(['owner' => $user, 'FootballMatch' => $match, 'confirmed' => false]);

            if (empty($userMatchTickets)) {
                $errors[] = "Uživatel nemá zakoupené vstupenky na tento zápas";

                return $this->render('admin/match-register.html.twig', [
                    "match" => $match,
                    "errors" => $errors
                ]);
            }



            $numberOfAdultTickets = 0;
            $numberOfChildTickets = 0;

            foreach ($userMatchTickets as $ticket) {
                if ($ticket->getType() === 'adult') {
                    $numberOfAdultTickets++;
                } else if ($ticket->getType() === 'child') {
                    $numberOfChildTickets++;
                }
            }

            dump($userMatchTickets);

            return $this->render('admin/match-register.html.twig', [
                "match" => $match,
                "errors" => $errors,
                'numberOfAdultTickets' => $numberOfAdultTickets,
                'numberOfChildTickets' => $numberOfChildTickets,
                'user' => $user
            ]);
        }


        return $this->render('admin/match-register.html.twig', [
            "match" => $match,
            "errors" => $errors,
        ]);
    }

    #[Route('/admin-users/confirm-tickets/{user}/{slug}', name: 'app_admin_confirm_tickets', methods: ['POST'])]
    public function confirmUsersTickets(string $user, string $slug, EntityManagerInterface $em): Response
    {
        $allUsers = $em->getRepository(User::class)->findOneBy(['email' => $user]);
        $match = $em->getRepository(FootballMatch::class)->findOneBy(['slug' => $slug]);
        $tickets = $em->getRepository(Ticket::class)->findBy(['owner' => $allUsers, 'FootballMatch' => $match]);

        foreach ($tickets as $ticket) {
            $ticket->setConfirmed(true);
            $em->persist($ticket);
        }

        $em->flush();


        return $this->redirectToRoute('app_admin_match_register', ['slug' => $slug]);
    }

    #[Route('/admin-match/stats/{slug}', name: 'app_admin_match_stats')]
    public function matchStats(string $slug, EntityManagerInterface $em): Response
    {
        $match = $em->getRepository(FootballMatch::class)->findOneBy(['slug' => $slug]);
        $tickets = $em->getRepository(Ticket::class)->findBy(['FootballMatch' => $match, 'confirmed' => true]);

        $numberOfAdultTickets = 0;
        $numberOfChildTickets = 0;

        foreach ($tickets as $ticket) {
            if ($ticket->getType() === 'adult') {
                $numberOfAdultTickets++;
            } else if ($ticket->getType() === 'child') {
                $numberOfChildTickets++;
            }
        }

        return $this->render('admin/match-stats.html.twig', [
            "match" => $match,
            "numberOfAdultTickets" => $numberOfAdultTickets,
            "numberOfChildTickets" => $numberOfChildTickets
        ]);
    }

    #[Route('/admin-users', name: 'app_admin_users')]
    public function users(EntityManagerInterface $em): Response
    {
        $allUsers = $em->getRepository(User::class)->findAll();

        dump($allUsers);


        return $this->render('admin/users.html.twig', [
            "users" => $allUsers,
        ]);
    }

    #[Route('/admin-users/{email}', name: 'app_admin_user_edit')]
    public function user(string $email, EntityManagerInterface $em, Request $request): Response
    {
        $user = $em->getRepository(User::class)->findOneBy(['email' => $email]);
        $status = "";

        if (!$user) {
            throw $this->createNotFoundException("User not found");
        }

        $mainRole = [0];

        if (in_array("ROLE_ADMIN", $user->getRoles())) {
            $mainRole = "ROLE_ADMIN";
        } elseif (in_array("ROLE_CASHIER", $user->getRoles())) {
            $mainRole = "ROLE_CASHIER";
        } elseif (in_array("ROLE_USER", $user->getRoles())) {
            $mainRole = "ROLE_USER";
        }

        $form = $this->createForm(EditUserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($user);
            $em->flush();
            $status = "success";
        }

        return $this->render('admin/user-edit.html.twig', [
            "user" => $user,
            "form" => $form->createView(),
            "mainRole" => $mainRole,
            "status" => $status
        ]);
    }

    #[Route('/admin-entrances', name: 'app_admin_entrances')]
    public function entrances(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }
}
