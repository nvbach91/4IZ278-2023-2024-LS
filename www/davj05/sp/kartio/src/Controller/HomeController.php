<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

#[Route("/home")]
class HomeController extends AbstractController
{
    #[Route("", name: "app_home", methods: ["GET"])]
    public function index()
    {
        return $this->render("home/index.html.twig");
    }
}
