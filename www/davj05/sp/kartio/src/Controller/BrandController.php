<?php

namespace App\Controller;

use App\Document\Brand;
use App\Document\LoyaltyCard;
use App\Document\User;
use App\Form\BrandType;
use App\Form\LoyaltyCardType;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Validator\ConstraintViolation;

#[Route("/brands")]
#[IsGranted("ROLE_ADMIN")]
class BrandController extends AbstractController
{
    #[Route("", name: "app_brands", methods: ["GET"])]
    public function brands(DocumentManager $dm, UserInterface $user): Response
    {
        $brands = $dm->getRepository(Brand::class)->findAll();
        $accessibleBrands = [];
        $brandsAdminCount = [];

        foreach ($brands as $brand) {
            if ($brand->getUsers()->contains($user)) {
                $accessibleBrands[] = $brand;

                $adminCount = 0;
                foreach ($brand->getUsers() as $brandUser) {
                    if (in_array("ROLE_ADMIN", $brandUser->getRoles())) {
                        $adminCount++;
                    }
                }
                $brandsAdminCount[$brand->getId()] = $adminCount;
            }
        }

        return $this->render("brands/index.html.twig", [
            "brands" => $accessibleBrands,
            "brandsAdminCount" => $brandsAdminCount,
        ]);
    }

    #[Route("/brand/{id}", name: "app_brand", methods: ["GET"])]
    public function brand(DocumentManager $dm, string $id, UserInterface $user): Response
    {
        $brand = $dm->getRepository(Brand::class)->find($id);

        if (!$brand->getUsers()->contains($user)) {
            throw $this->createAccessDeniedException("You do not have access to this brand.");
        }

        if (!$brand) {
            throw $this->createNotFoundException("Brand not found!");
        }

        return $this->render("brands/show.html.twig", [
            "brand" => $brand,
        ]);
    }

    #[Route("/new", name: "app_new_brand", methods: ["GET", "POST"])]
    public function newBrand(Request $request, DocumentManager $dm, UserInterface $user): Response
    {
        $brand = new Brand("");
        $form = $this->createForm(BrandType::class, $brand);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $existingBrand = $dm->getRepository(Brand::class)->findOneBy(["name" => $form->get("name")->getData()]);

                if ($existingBrand) {
                    $this->addFlash("error", "Taková značka již existuje.");
                } else {
                    $brand->setName($form->get("name")->getData());
                    $brand->addUser($user);

                    $pictureFile = $form->get("picture")->getData();
                    if ($pictureFile) {
                        $originalFilename = pathinfo($pictureFile->getClientOriginalName(), PATHINFO_FILENAME);
                        $safeFilename = $this->sanitizeFilename($originalFilename);
                        $newFilename = $safeFilename . "-" . uniqid() . "." . $pictureFile->guessExtension();

                        try {
                            $pictureFile->move(
                                $this->getParameter("pictures_directory"),
                                $newFilename
                            );
                            $brand->setPicturePath($newFilename);
                        } catch (FileException $e) {
                            $this->addFlash("error", "Došlo k chybě při nahrávání souboru.");
                        }
                    }

                    $dm->persist($brand);
                    $dm->flush();

                    $this->addFlash("success", "Značka byla vytvořena.");
                    return $this->redirectToRoute("app_brands");
                }
            } else {
                $errors = $form->getErrors(true, true);
                foreach ($errors as $error) {
                    $this->addFlash("error", $error->getMessage());
                }
            }
        }

        return $this->render("brands/new.html.twig", [
            "form" => $form->createView(),
        ]);
    }

    #[Route("/brand/{id}/add-card", name: "app_add_card", methods: ["GET", "POST"])]
    public function addLoyaltyCard(Brand $brand, Request $request, DocumentManager $dm, UserPasswordHasherInterface $passwordHasher): Response
    {
        $loyaltyCard = new LoyaltyCard("", "", "", null);

        $form = $this->createForm(LoyaltyCardType::class, $loyaltyCard);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if ($form->isValid()) {
                $existingCard = $dm->getRepository(LoyaltyCard::class)->findOneBy(["cardIdentifier" => $loyaltyCard->getCardIdentifier()]);

                if ($existingCard) {
                    $this->addFlash("error", "Karta s tímto identifikátorem již existuje.");
                } else {
                    try {
                        $email = $loyaltyCard->getEmail();
                        $user = $dm->getRepository(User::class)->findOneBy(["email" => $email]);

                        if (!$user) {
                            $user = new User();
                            $user->setEmail($email);

                            $randomPassword = $this->generateRandomPassword();
                            $hashedPassword = $passwordHasher->hashPassword($user, $randomPassword);
                            $user->setPassword($hashedPassword);

                            $dm->persist($user);

                            $this->addFlash("success", "Byl vytvořen nový uživatel s emailem: $email a heslem: $randomPassword");
                        }

                        $loyaltyCard->setBrand($brand);
                        $dm->persist($loyaltyCard);
                        $dm->flush();
                        $this->addFlash("success", "Karta byla přidána.");

                        return $this->redirectToRoute("app_brand", ["id" => $brand->getId()]);
                    } catch (\Exception $e) {
                        $this->addFlash("error", $e->getMessage());
                    }
                }
            } else {
                $errors = $form->getErrors(true, true);
                foreach ($errors as $error) {
                    $this->addFlash("error", $error->getMessage());
                }
            }
        }

        return $this->render("brands/add_card.html.twig", [
            "form" => $form->createView(),
            "brand" => $brand,
        ]);
    }

    #[Route("/brand/{id}/remove-card", name: "app_remove_card", methods: ["POST"])]
    public function removeLoyaltyCard(Brand $brand, Request $request, DocumentManager $dm): Response
    {
        $cardIdentifier = $request->request->get("cardIdentifier");

        try {
            $card = $dm->getRepository(LoyaltyCard::class)->findOneBy(["cardIdentifier" => $cardIdentifier]);
            if ($card) {
                $dm->remove($card);
                $dm->flush();
                $this->addFlash("success", "Karta byla odebrána.");
            } else {
                $this->addFlash("error", "Karta nebyla nalezena.");
            }
        } catch (\Exception $e) {
            $this->addFlash("error", $e->getMessage());
        }

        return $this->redirectToRoute("app_brand", ["id" => $brand->getId()]);
    }

    #[Route("/brand/{id}/invite", name: "app_brand_invite", methods: ["GET", "POST"])]
    public function invite(UserInterface $user, Brand $brand, Request $request, DocumentManager $dm): Response
    {
        if ($request->isMethod("POST")) {
            $email = $request->request->get("email");
            $invitee = $dm->getRepository(User::class)->findOneBy(["email" => $email]);

            if ($invitee) {
                if (!$brand->getUsers()->contains($invitee)) {
                    $brand->addUser($invitee);
                    $dm->flush();
                    $this->addFlash("success", "Uživatel byl pozván.");
                } else {
                    $this->addFlash("error", "Uživatel již má přístup.");
                }
            } else {
                $this->addFlash("error", "Uživatel nebyl nalezen.");
            }

            return $this->redirectToRoute("app_brand_invite", ["id" => $brand->getId()]);
        }

        return $this->render("brands/invite.html.twig", [
            "brand" => $brand,
        ]);
    }

    private function generateRandomPassword($length = 12): string
    {
        return bin2hex(random_bytes($length / 2));
    }

    private function sanitizeFilename(string $filename): string
    {
        $filename = preg_replace("/[^A-Za-z0-9]/", "_", $filename);
        return strtolower($filename);
    }
}
