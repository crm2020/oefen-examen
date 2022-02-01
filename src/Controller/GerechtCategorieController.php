<?php

namespace App\Controller;

use App\Entity\GerechtCategorie;
use App\Form\GerechtCategorieType;
use App\Repository\GerechtCategorieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/gerecht/categorie')]
class GerechtCategorieController extends AbstractController
{
    #[Route('/', name: 'gerecht_categorie_index', methods: ['GET'])]
    public function index(GerechtCategorieRepository $gerechtCategorieRepository): Response
    {
        return $this->render('gerecht_categorie/index.html.twig', [
            'gerecht_categories' => $gerechtCategorieRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'gerecht_categorie_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $gerechtCategorie = new GerechtCategorie();
        $form = $this->createForm(GerechtCategorieType::class, $gerechtCategorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($gerechtCategorie);
            $entityManager->flush();

            return $this->redirectToRoute('gerecht_categorie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('gerecht_categorie/new.html.twig', [
            'gerecht_categorie' => $gerechtCategorie,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'gerecht_categorie_show', methods: ['GET'])]
    public function show(GerechtCategorie $gerechtCategorie): Response
    {
        return $this->render('gerecht_categorie/show.html.twig', [
            'gerecht_categorie' => $gerechtCategorie,
        ]);
    }

    #[Route('/{id}/edit', name: 'gerecht_categorie_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, GerechtCategorie $gerechtCategorie, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(GerechtCategorieType::class, $gerechtCategorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('gerecht_categorie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('gerecht_categorie/edit.html.twig', [
            'gerecht_categorie' => $gerechtCategorie,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'gerecht_categorie_delete', methods: ['POST'])]
    public function delete(Request $request, GerechtCategorie $gerechtCategorie, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$gerechtCategorie->getId(), $request->request->get('_token'))) {
            $entityManager->remove($gerechtCategorie);
            $entityManager->flush();
        }

        return $this->redirectToRoute('gerecht_categorie_index', [], Response::HTTP_SEE_OTHER);
    }
}
