<?php

namespace App\Controller;

use App\Repository\UserRepository;  // Assurez-vous que le bon repository est utilisé
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class LoginController extends AbstractController
{
    private $userRepository;

    // Injecter le repository UserRepository
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    #[Route('/login', name: 'app_login')]
    public function index(AuthenticationUtils $authenticationUtils): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();
        $errorMessage = '';

        // Vérifier si l'email existe dans la base de données
        $user = $this->userRepository->findOneBy(['email' => $lastUsername]);

        if ($error) {
            // Si un utilisateur avec cet email existe, on vérifie le mot de passe
            if ($user) {
                // Si le mot de passe est incorrect
                $errorMessage = 'Mot de passe incorrect';
            } else {
                // Si l'email n'existe pas dans la base de données
                $errorMessage = 'Email incorrect';
            }
        }

        return $this->render('login/index.html.twig', [
            'last_username' => $lastUsername,
            'error' => $errorMessage,
        ]);
    }
}
