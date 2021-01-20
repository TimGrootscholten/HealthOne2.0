<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DocterController extends AbstractController
{
    /**
     * @Route("/receptenn", name="receptenn")
     */
    public function recepten(): Response
    {
        return $this->render('dokter/recepten.html.twig', [
            'controller_name' => 'recepten',
        ]);
    }
}
