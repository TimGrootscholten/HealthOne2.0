<?php

namespace App\Controller;

use App\Entity\Medicijnen;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GlobaalController extends AbstractController
{
    /**
     * @Route("/", name="homePage")
     */
    public function index(): Response
    {
        return $this->render('globaal/index.html.twig', [
            'controller_name' => 'ApotheekController',
        ]);
    }

    /**
     * @Route("/medicijn", name="patientMedicijn")
     */
    public function medicijn(): Response
    {
        $repository = $this->getDoctrine()->getRepository(Medicijnen::class);
        $medicijnen = $repository->findAll();
        return $this->render('globaal/medicijn.html.twig', ['medicijnen' => $medicijnen]);
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contact()
    {
        return $this->render('globaal/contact.html.twig');
    }

    /**
     * @Route("/login", name="login")
     */
    public function login(): Response
    {
        return $this->render('globaal/index.html.twig', [
            'controller_name' => 'login',
        ]);
    }
}