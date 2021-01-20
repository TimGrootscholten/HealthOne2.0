<?php

namespace App\Controller;

use App\Entity\Medicijnen;
use App\Entity\Recepten;
use App\Form\MedicijnController;
use App\Form\ReceptenType;
use App\Repository\MedicijnenRepository;
use App\Repository\ReceptenRepository;
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
    public function medicijn(MedicijnenRepository $medicijnenRepository): Response
    {
        $medicijnen=$medicijnenRepository->findAll();
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
     * @Route("/medicijn/remove{id}", name="medicijnRemove")
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

    /**
     * @Route("/recept", name="recept")
     */
    public function recept(ReceptenRepository $receptenRepository): Response
    {
        $recepten=$receptenRepository->findAll();
        return $this->render('recepten/Recepten.html.twig', ['recepten'=> $recepten]);
    }

    /**
     * @Route("/recept/add", name="receptAdd")
     */
    public function addRecept(EntityManagerInterface $em,Request $request){


        $form = $this->createForm(ReceptenType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $recept=$form->getData();
            $em->persist($recept);
            $em->flush();

            $this->addFlash(
                'notice',
                "recept toegevoegd!"
            );

            return $this->redirectToRoute('recept');
        }

        return $this->render('recepten/addRecepten.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/recept/remove{id}", name="receptRemove")
     */
    public function removeRecept(Recepten $recept){
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($recept);
        $entityManager->flush();


        return $this->redirectToRoute('recept');
    }

    /**
     * @Route("/recept/Update{id}", name="receptUpdate")
     */
    public function updateRecept(EntityManagerInterface $em, Request $request, Recepten $recept){
        $form = $this->createForm(ReceptenType::class, $recept);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $em->persist($recept);
            $em->flush();
            $this->addFlash('success', 'Article Created! Knowledge is power!');
            return $this->redirectToRoute('recept');
        }

        return $this->render('recepten/editRecepten.html.twig', [
            'recept' => $recept,
            'form' => $form->createView(),
        ]);
    }
}
