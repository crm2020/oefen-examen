<?php

namespace App\Controller;

use App\Entity\Klanten;
use App\Form\KlantenType;
use App\Repository\KlantenRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/klanten')]
class KlantenController extends AbstractController
{
    #[Route('/klanten', name: 'klanten_index', methods: ['GET'])]
    public function index(KlantenRepository $klantenRepository): Response
    {
        return $this->render('klanten/index.html.twig', [
            'klantens' => $klantenRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'klanten_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $klanten = new Klanten();
        $form = $this->createForm(KlantenType::class, $klanten);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($klanten);
            $entityManager->flush();

            return $this->redirectToRoute('klanten_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('klanten/new.html.twig', [
            'klanten' => $klanten,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'klanten_show', methods: ['GET'])]
    public function show(Klanten $klanten): Response
    {
        return $this->render('klanten/show.html.twig', [
            'klanten' => $klanten,
        ]);
    }

    #[Route('/{id}/edit', name: 'klanten_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Klanten $klanten, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(KlantenType::class, $klanten);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('klanten_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('klanten/edit.html.twig', [
            'klanten' => $klanten,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'klanten_delete', methods: ['POST'])]
    public function delete(Request $request, Klanten $klanten, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$klanten->getId(), $request->request->get('_token'))) {
            $entityManager->remove($klanten);
            $entityManager->flush();
        }

        return $this->redirectToRoute('klanten_index', [], Response::HTTP_SEE_OTHER);
    }
}
