<?php

namespace App\Controller;

use App\Entity\GerechtSoorten;
use App\Form\GerechtSoortenType;
use App\Repository\GerechtSoortenRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/gerecht/soorten')]
class GerechtSoortenController extends AbstractController
{
    #[Route('/', name: 'gerecht_soorten_index', methods: ['GET'])]
    public function index(GerechtSoortenRepository $gerechtSoortenRepository): Response
    {
        return $this->render('gerecht_soorten/index.html.twig', [
            'gerecht_soortens' => $gerechtSoortenRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'gerecht_soorten_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $gerechtSoorten = new GerechtSoorten();
        $form = $this->createForm(GerechtSoortenType::class, $gerechtSoorten);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($gerechtSoorten);
            $entityManager->flush();

            return $this->redirectToRoute('gerecht_soorten_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('gerecht_soorten/new.html.twig', [
            'gerecht_soorten' => $gerechtSoorten,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'gerecht_soorten_show', methods: ['GET'])]
    public function show(GerechtSoorten $gerechtSoorten): Response
    {
        return $this->render('gerecht_soorten/show.html.twig', [
            'gerecht_soorten' => $gerechtSoorten,
        ]);
    }

    #[Route('/{id}/edit', name: 'gerecht_soorten_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, GerechtSoorten $gerechtSoorten, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(GerechtSoortenType::class, $gerechtSoorten);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('gerecht_soorten_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('gerecht_soorten/edit.html.twig', [
            'gerecht_soorten' => $gerechtSoorten,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'gerecht_soorten_delete', methods: ['POST'])]
    public function delete(Request $request, GerechtSoorten $gerechtSoorten, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$gerechtSoorten->getId(), $request->request->get('_token'))) {
            $entityManager->remove($gerechtSoorten);
            $entityManager->flush();
        }

        return $this->redirectToRoute('gerecht_soorten_index', [], Response::HTTP_SEE_OTHER);
    }
}
