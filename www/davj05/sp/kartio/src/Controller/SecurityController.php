<?php

namespace App\Controller;

use App\Document\User;
use App\Form\RegistrationType;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

# This controller is responsible for handling security-related actions
# such as user registration, login, and logout.

class SecurityController extends AbstractController
{
    # This method is responsible for rendering the registration form
    #[Route("/register", name: "app_register")]
    public function register(Request $request, DocumentManager $dm, UserPasswordHasherInterface $passwordHasher): Response
    {
        $user = new User();

        $form = $this->createForm(RegistrationType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Hash the password
            $hashedPassword = $passwordHasher->hashPassword($user, $user->getPassword());
            $user->setPassword($hashedPassword);

            // Ensure email is set from form data
            $email = $form->get("email")->getData();
            $user->setEmail($email);

            // Assign roles based on the select value
            $role = $form->get("role")->getData();
            $user->setRoles([$role]);

            // Persist the user to the database
            $dm->persist($user);
            $dm->flush();

            // Add a flash message for successful registration
            $this->addFlash("success", "Registrace byla úspěšná.");

            // Redirect to the login page
            return $this->redirectToRoute("app_login");
        }

        return $this->render("security/register.html.twig", [
            "form" => $form->createView(),
        ]);
    }

    # This method is responsible for rendering the login form
    #[Route("/login", name: "app_login")]
    public function login(AuthenticationUtils $authUtils): Response
    {
        $error = $authUtils->getLastAuthenticationError();
        $lastUsername = $authUtils->getLastUsername();

        if ($error) {
            $this->addFlash("error", "Přihlášení selhalo, prosím zkuste to znovu.");
        }

        return $this->render("security/login.html.twig", [
            "last_username" => $lastUsername,
            "error" => $error,
        ]);
    }

    # This method is responsible for logging out the user
    #[Route("/logout", name: "app_logout")]
    public function logout(): void
    {
        throw new \Exception("This should never be reached!");
    }
}
