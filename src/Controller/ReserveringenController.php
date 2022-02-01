<?php

namespace App\Controller;

use App\Entity\Reserveringen;
use App\Form\ReserveringenType;
use App\Repository\ReserveringenRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/reserveringen')]
class ReserveringenController extends AbstractController
{
    #[Route('/', name: 'reserveringen_index', methods: ['GET'])]
    public function index(ReserveringenRepository $reserveringenRepository): Response
    {
        return $this->render('reserveringen/index.html.twig', [
            'reserveringens' => $reserveringenRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'reserveringen_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $reserveringen = new Reserveringen();
        $form = $this->createForm(ReserveringenType::class, $reserveringen);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($reserveringen);
            $entityManager->flush();

            return $this->redirectToRoute('reserveringen_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('reserveringen/new.html.twig', [
            'reserveringen' => $reserveringen,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'reserveringen_show', methods: ['GET'])]
    public function show(Reserveringen $reserveringen): Response
    {
        return $this->render('reserveringen/show.html.twig', [
            'reserveringen' => $reserveringen,
        ]);
    }

    #[Route('/{id}/edit', name: 'reserveringen_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Reserveringen $reserveringen, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ReserveringenType::class, $reserveringen);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('reserveringen_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('reserveringen/edit.html.twig', [
            'reserveringen' => $reserveringen,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'reserveringen_delete', methods: ['POST'])]
    public function delete(Request $request, Reserveringen $reserveringen, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$reserveringen->getId(), $request->request->get('_token'))) {
            $entityManager->remove($reserveringen);
            $entityManager->flush();
        }

        return $this->redirectToRoute('reserveringen_index', [], Response::HTTP_SEE_OTHER);
    }
}
