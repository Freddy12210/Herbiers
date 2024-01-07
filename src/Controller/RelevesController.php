<?php

namespace App\Controller;

use App\Entity\Releves;
use App\Form\RelevesType;
use App\Repository\RelevesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/releves')]
class RelevesController extends AbstractController
{
    #[Route('/', name: 'app_releves_index', methods: ['GET'])]
    public function index(RelevesRepository $relevesRepository): Response
    {
        return $this->render('releves/index.html.twig', [
            'releves' => $relevesRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_releves_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $releve = new Releves();
        $form = $this->createForm(RelevesType::class, $releve);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($releve);
            $entityManager->flush();

            return $this->redirectToRoute('app_releves_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('releves/new.html.twig', [
            'releve' => $releve,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_releves_show', methods: ['GET'])]
    public function show(Releves $releve): Response
    {
        return $this->render('releves/show.html.twig', [
            'releve' => $releve,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_releves_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Releves $releve, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(RelevesType::class, $releve);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_releves_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('releves/edit.html.twig', [
            'releve' => $releve,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_releves_delete', methods: ['POST'])]
    public function delete(Request $request, Releves $releve, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$releve->getId(), $request->request->get('_token'))) {
            $entityManager->remove($releve);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_releves_index', [], Response::HTTP_SEE_OTHER);
    }
}
