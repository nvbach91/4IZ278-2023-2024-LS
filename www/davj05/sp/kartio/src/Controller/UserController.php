<?php

namespace App\Controller;

use App\Document\Brand;
use App\Document\LoyaltyCard;
use App\Document\User;
use Doctrine\ODM\MongoDB\DocumentManager;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security as SecurityBundleSecurity;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

# This controller is responsible for handling user-related actions
# such as viewing loyalty cards.

#[Route("/customer")]
#[IsGranted("ROLE_USER")]
class UserController extends AbstractController
{
    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    # This method is responsible for rendering the list of loyalty cards
    #[Route("/loyalty-cards", name: "app_customer_loyalty_cards")]
    public function loyaltyCards(DocumentManager $dm, SecurityBundleSecurity $security, PaginatorInterface $paginator, Request $request): Response
    {
        $user = $security->getUser();

        if (!$user instanceof User) {
            throw new \LogicException("Přihlášený uživatel nemá platný formát.");
        }

        $email = $user->getEmail(); // This gets the email
        $this->logger->info("User email: " . $email);

        $brands = $dm->getRepository(Brand::class)->findAll();
        $loyaltyCards = [];

        # Loop through all brands and their loyalty cards
        foreach ($brands as $brand) {
            $this->logger->info("Processing brand: " . $brand->getName());
            foreach ($brand->getLoyaltyCards() as $card) {
                $this->logger->info("Checking card with email: " . $card->getEmail());
                if ($card->getEmail() === $email) {
                    $this->logger->info("Found matching card for user");
                    $loyaltyCards[] = $card;
                }
            }
        }

        $pagination = $paginator->paginate(
            $loyaltyCards,
            $request->query->getInt("page", 1), // Current page number
            2
        );

        return $this->render("customer/loyalty_cards.html.twig", [
            "pagination" => $pagination,
        ]);
    }

    #[Route("/loyalty-card/{id}", name: "app_customer_loyalty_card_detail", methods: ["GET"])]
    public function loyaltyCardDetail(string $id, DocumentManager $dm, SecurityBundleSecurity $security): Response
    {
        $user = $security->getUser();

        if (!$user instanceof User) {
            throw new \LogicException("Přihlášený uživatel nemá platný formát.");
        }

        $this->logger->info("ID: " . $id);


        $brands = $dm->getRepository(Brand::class)->findAll();
        $loyaltyCard = null;

        # Loop through all brands and their loyalty cards
        foreach ($brands as $brand) {
            foreach ($brand->getLoyaltyCards() as $card) {
                if ($card->getCardIdentifier() === $id) {
                    $loyaltyCard = $card;
                    break 2;  // Break both loops
                }
            }
        }
        if (!$loyaltyCard) {
            throw $this->createNotFoundException("Karta nebyla nalezena.");
        }

        // if ($loyaltyCard->getEmail() !== $user->getEmail()) {
        //     throw $this->createAccessDeniedException("K této kartě nemáte přístup.");
        // }

        return $this->render("customer/loyalty_card_detail.html.twig", [
            "loyaltyCard" => $loyaltyCard,
        ]);
    }


    #[Route("/loyalty-card/{id}/qr", name: "app_customer_loyalty_card_qr", methods: ["GET"])]
    public function loyaltyCardQr(string $id, DocumentManager $dm, SecurityBundleSecurity $security): Response
    {
        $user = $security->getUser();

        if (!$user instanceof User) {
            throw new \LogicException("Přihlášený uživatel nemá platný formát.");
        }

        $brands = $dm->getRepository(Brand::class)->findAll();
        $loyaltyCard = null;

        foreach ($brands as $brand) {
            foreach ($brand->getLoyaltyCards() as $card) {
                if ($card->getCardIdentifier() === $id) {
                    $loyaltyCard = $card;
                    break 2;
                }
            }
        }

        if (!$loyaltyCard) {
            throw $this->createNotFoundException("Karta nebyla nalezena.");
        }

        // if ($loyaltyCard->getEmail() !== $user->getEmail()) {
        //     throw $this->createAccessDeniedException("Nemáte přístup k této kartě.");
        // }

        $qrContent = sprintf(
            "Brand: %s\nCustomer: %s\nEmail: %s\nPhone: %s\nCard ID: %s",
            $loyaltyCard->getBrand() ? $loyaltyCard->getBrand()->getName() : "Unknown",
            $loyaltyCard->getCustomerName(),
            $loyaltyCard->getEmail(),
            $loyaltyCard->getPhoneNumber(),
            $loyaltyCard->getCardIdentifier()
        );

        $qrUrl = "https://api.qrserver.com/v1/create-qr-code/?size=150x150&data=" . urlencode($qrContent);

        $httpClient = HttpClient::create();
        $response = $httpClient->request("GET", $qrUrl);

        return new Response($response->getContent(), 200, ["Content-Type" => "image/png"]);
    }
}
