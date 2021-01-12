<?php

namespace App\Controller;

use App\Entity\Medicijnen;
use App\Form\MedicijnController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApotheekController extends AbstractController
{

    /**
     * @Route("/medicijn", name="medicijn")
     */
    public function medicijn(): Response
    {
        $repository=$this->getDoctrine()->getRepository(Medicijnen::class);
        $medicijnen=$repository->findAll();
        return $this->render('apotheek/medicijn.html.twig', ['medicijnen'=> $medicijnen]);
    }

    /**
     * @Route("/medicijn/add", name="medicijnAdd")
     */
    public function addMedicijn(Request $request){
        $medicijn = new Medicijnen();

        $form = $this->createForm(MedicijnController::class, $medicijn);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($medicijn);
            $em->flush();

            $this->addFlash(
                'notice',
                "medicijn toegevoegd!"
            );
            return $this->redirectToRoute('medicijn');
        }

        return $this->render('apotheek/addMedicijn.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/medicijn/remove{id}", name="medicijnRemove", methods={"DELETE"})
     */
    public function removeMedicijn(Medicijnen $medicijn){
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($medicijn);
            $entityManager->flush();


        return $this->redirectToRoute('medicijn');
    }

    /**
     * @Route("/medicijn/Update{id}", name="medicijnUpdate")
     */
    public function updateMedicijn(EntityManagerInterface $em, Request $request, Medicijnen $medicijn){
        $form = $this->createForm(MedicijnController::class, $medicijn);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $em->persist($medicijn);
            $em->flush();
            $this->addFlash('success', 'Article Created! Knowledge is power!');
            return $this->redirectToRoute('medicijn');
        }

        return $this->render('apotheek/editMedicijn.html.twig', [
            'medicijnen' => $medicijn,
            'form' => $form->createView(),
        ]);
    }

}
