<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DokterController extends AbstractController
{
    /**
     * @Route("/", name="dokter")
     */
    public function index(): Response
    {
        return $this->render('dokter/index.html.twig', [
            'controller_name' => 'DokterController',
        ]);
    }

    /**
     * @Route("/medicijn", name="medicijn")
     */
    public function medicijn(): Response
    {
        return $this->render('dokter/index.html.twig', [
            'controller_name' => 'medicijn',
        ]);
    }
    /**
     * @Route("/login", name="login")
     */
    public function login(): Response
    {
        return $this->render('dokter/index.html.twig', [
            'controller_name' => 'login',
        ]);
    }
    /**
     * @Route("/patient", name="patient")
     */
    public function patient(): Response
    {
        return $this->render('dokter/index.html.twig', [
            'controller_name' => 'patient',
        ]);
    }
}
