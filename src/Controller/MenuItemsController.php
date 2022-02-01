<?php

namespace App\Controller;

use App\Entity\MenuItems;
use App\Form\MenuItemsType;
use App\Repository\MenuItemsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/menu/items')]
class MenuItemsController extends AbstractController
{
    #[Route('/', name: 'menu_items_index', methods: ['GET'])]
    public function index(MenuItemsRepository $menuItemsRepository): Response
    {
        return $this->render('menu_items/index.html.twig', [
            'menu_items' => $menuItemsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'menu_items_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $menuItem = new MenuItems();
        $form = $this->createForm(MenuItemsType::class, $menuItem);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($menuItem);
            $entityManager->flush();

            return $this->redirectToRoute('menu_items_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('menu_items/new.html.twig', [
            'menu_item' => $menuItem,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'menu_items_show', methods: ['GET'])]
    public function show(MenuItems $menuItem): Response
    {
        return $this->render('menu_items/show.html.twig', [
            'menu_item' => $menuItem,
        ]);
    }

    #[Route('/{id}/edit', name: 'menu_items_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, MenuItems $menuItem, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(MenuItemsType::class, $menuItem);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('menu_items_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('menu_items/edit.html.twig', [
            'menu_item' => $menuItem,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'menu_items_delete', methods: ['POST'])]
    public function delete(Request $request, MenuItems $menuItem, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$menuItem->getId(), $request->request->get('_token'))) {
            $entityManager->remove($menuItem);
            $entityManager->flush();
        }

        return $this->redirectToRoute('menu_items_index', [], Response::HTTP_SEE_OTHER);
    }
}
