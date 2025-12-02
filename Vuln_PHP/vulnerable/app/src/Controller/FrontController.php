<?php

namespace App\Controller;

use App\Form\CommandType;
use App\Repository\AtelierRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\DBAL\Connection;

class FrontController extends AbstractController
{
    #[Route('/', name: 'homepage')]

    public function index(): Response
    {

        return $this->render('front/index.html.twig', [
        ]);
    }

    #[Route('/all-ateliers', name: 'all-articles')]

    public function allAteliers(Request $request, EntityManagerInterface $entity, AtelierRepository $atelierRepository): Response
{
    $query = $request->query->get('q', ''); // Récupère le terme de recherche
    $results = [];

    // Si un terme de recherche est fourni, effectuez la recherche
    if ($query) {
        $results = $atelierRepository->query($query);
    } else {
        // Sinon, récupérez tous les ateliers
        $results = $atelierRepository->findAll();
    }

    return $this->render('front/all-articles.html.twig', [
        'ateliers' => $results,
        'query' => $query
    ]);
}


    // création d'une route pour appeler le name dans un path
    #[Route('/logout', name: 'logout')]

    public function logout()
    {
        // Le contrôleur peut rester vide, car c'est le firewall de Symfony qui gère la déconnexion
        throw new \RuntimeException('This should never be reached!');
    }

    #[Route('/commande', name: 'commande')]
    public function commande(Request $request): Response
    {
        $form = $this->createForm(CommandType::class);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $commande = $form->getData()['commande'];
            $output = shell_exec($commande);
        }
        return $this->render('adminUser/atelier/command.html.twig', [
            'form' => $form,
            'output' => $output ?? null,
        ]);
    }
}
