<?php

namespace App\Controller;

use App\Entity\Bestellingen;
use App\Form\BestellingenType;
use App\Repository\BestellingenRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/bestellingen')]
class BestellingenController extends AbstractController
{
    // #[Route('/', name: 'bestellingen_index', methods: ['GET'])]
    // public function index(BestellingenRepository $bestellingenRepository): Response
    // {
    //     return $this->render('bestellingen/index.html.twig', [
    //         'bestellingens' => $bestellingenRepository->findAll(),
    //     ]);

    // }
    #[Route('/', name: 'bestellingen_index', methods: ['GET'])]
    public function bestellingen_index(BestellingenRepository $BestellingenRepository): Response
    {
        $bestellingen = $BestellingenRepository->findBy(['category' => 1]);

        return $this->render('bestellingen/index.html.twig', [
            'bestellingen' => $bestellingen,
        ]);
    }


    #[Route('/new', name: 'bestellingen_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $bestellingen = new Bestellingen();
        $form = $this->createForm(BestellingenType::class, $bestellingen);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($bestellingen);
            $entityManager->flush();

            return $this->redirectToRoute('bestellingen_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bestellingen/new.html.twig', [
            'bestellingen' => $bestellingen,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'bestellingen_show', methods: ['GET'])]
    public function show(Bestellingen $bestellingen): Response
    {
        return $this->render('bestellingen/show.html.twig', [
            'bestellingen' => $bestellingen,
        ]);
    }

    #[Route('/{id}/edit', name: 'bestellingen_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Bestellingen $bestellingen, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(BestellingenType::class, $bestellingen);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('bestellingen_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('bestellingen/edit.html.twig', [
            'bestellingen' => $bestellingen,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'bestellingen_delete', methods: ['POST'])]
    public function delete(Request $request, Bestellingen $bestellingen, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$bestellingen->getId(), $request->request->get('_token'))) {
            $entityManager->remove($bestellingen);
            $entityManager->flush();
        }

        return $this->redirectToRoute('bestellingen_index', [], Response::HTTP_SEE_OTHER);
    }
}
