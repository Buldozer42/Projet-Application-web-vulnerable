<?php

namespace App\Controller;

use App\Entity\Lycee;
use App\Form\LyceeType;
use App\Repository\LyceeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/lycee')]
class LyceeController extends AbstractController
{
    #[Route('/', name: 'app_lycee_index', methods: ['GET'])]
    public function index(LyceeRepository $lyceeRepository): Response
    {
        return $this->render('adminUser/lycee/index.html.twig', [
            'lycees' => $lyceeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_lycee_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $lycee = new Lycee();
        $form = $this->createForm(LyceeType::class, $lycee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($lycee);
            $entityManager->flush();

            return $this->redirectToRoute('app_lycee_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('adminUser/lycee/new.html.twig', [
            'lycee' => $lycee,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_lycee_show', methods: ['GET'])]
    public function show(Lycee $lycee): Response
    {
        return $this->render('adminUser/lycee/show.html.twig', [
            'lycee' => $lycee,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_lycee_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Lycee $lycee, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(LyceeType::class, $lycee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_lycee_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('adminUser/lycee/edit.html.twig', [
            'lycee' => $lycee,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_lycee_delete', methods: ['POST'])]
    public function delete(Request $request, Lycee $lycee, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$lycee->getId(), $request->request->get('_token'))) {
            $entityManager->remove($lycee);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_lycee_index', [], Response::HTTP_SEE_OTHER);
    }
}
