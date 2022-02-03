<?php

namespace App\Controller\admin;

use App\Entity\Flash;
use App\Form\FlashType;
use App\Form\SearchBarType;
use App\Repository\FlashRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/flash')]
class FlashController extends AbstractController
{
    #[Route('/', name: 'flash_index', methods: ['GET','POST'])]
    public function index(Request $request, FlashRepository $flashRepository): Response
    {

        $form = $this->createForm(SearchBarType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $search = $form->getData()['search'];
            $flashes = $flashRepository->findLikeName($search);
        } else {
            $flashes = $flashRepository->findAll();
        }

        return $this->render('admin/flash/index.html.twig', [
            'flashes' => $flashes,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/new', name: 'flash_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $flash = new Flash();
        $form = $this->createForm(FlashType::class, $flash);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($flash);
            $entityManager->flush();

            return $this->redirectToRoute('flash_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/flash/new.html.twig', [
            'flash' => $flash,
            'form' => $form
        ]);
    }

    #[Route('/{id}', name: 'flash_show', methods: ['GET'])]
    public function show(Flash $flash): Response
    {
        return $this->render('admin/flash/show.html.twig', [
            'flash' => $flash,
        ]);
    }

    #[Route('/{id}/edit', name: 'flash_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Flash $flash, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(FlashType::class, $flash);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('flash_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/flash/edit.html.twig', [
            'flash' => $flash,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'flash_delete', methods: ['POST'])]
    public function delete(Request $request, Flash $flash, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$flash->getId(), $request->request->get('_token'))) {
            $entityManager->remove($flash);
            $entityManager->flush();
        }

        return $this->redirectToRoute('flash_index', [], Response::HTTP_SEE_OTHER);
    }
}
