<?php

namespace App\Controller;

use App\Form\CommandType;
use App\Repository\AtelierRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class FrontController extends AbstractController
{
    #[Route('/', name: 'homepage')]

    public function index(): Response
    {
        return $this->render('front/index.html.twig', [
        ]);
    }

    #[Route('/all-ateliers', name: 'all-articles')]
    public function allAteliers(Request $request, AtelierRepository $atelierRepository): Response
    {
        // Récupère le terme de recherche
        $query = $request->query->get('q', '');
        $results = [];

        // Sanitisation : supprime les espaces inutiles
        $query = trim($query);

        // Si un terme de recherche est fourni, effectuez la recherche sinon récupérez tous les ateliers
        $results = $query ? $atelierRepository->findByNomOrIntervenant($query) : $atelierRepository->findAll();

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
    public function commande(Request $request, AtelierRepository $atelierRepository): Response
    {
        $form = $this->createForm(CommandType::class);
        $form->handleRequest($request);
        // Liste des commandes autorisées
        $allowedShellCommands = ['ls', 'date'];
        $allowedAppCommands = ['php bin/console app:total'];
        if ($form->isSubmitted() && $form->isValid()) {
            // Vérifie si la commande est dans la liste des commandes autorisées
            $commande = $form->getData()['commande'];
            if (in_array($commande, $allowedShellCommands)) {
                $output = shell_exec($commande);
            }
            elseif (in_array($commande, $allowedAppCommands)) {
                switch ($commande) {
                    case 'php bin/console app:total':
                        $totalAteliers = $atelierRepository->count([]);
                        $output = "Total des ateliers : " . $totalAteliers;
                        break;
                    default:
                        $output = 'Commande non autorisée.';
                }
            }
            else {
                $output = 'Commande non autorisée.';
            }
        }
        return $this->render('adminUser/atelier/command.html.twig', [
            'form' => $form,
            'output' => $output ?? null,
        ]);
    }
}
