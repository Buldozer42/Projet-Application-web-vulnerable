<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\RateLimiter\RateLimiterFactory;
use Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException;

class LoginController extends AbstractController
{
    private $userRepository;
    private $loginLimiter;

    public function __construct(
        UserRepository $userRepository,
        #[Autowire(service: 'limiter.loginLimiter')] RateLimiterFactory $loginLimiter
    ) {
        $this->userRepository = $userRepository;
        $this->loginLimiter = $loginLimiter;
    }

    #[Route('/login', name: 'app_login')]
    public function index(
        AuthenticationUtils $authenticationUtils,
        Request $request
    ): Response {
        // Limiter les tentatives par IP
        $limiter = $this->loginLimiter->create($request->getClientIp());
        
        //  Si la limite est dépassée, renvoyer une erreur 429
        if (false === $limiter->consume(1)->isAccepted()) {
            throw new TooManyRequestsHttpException('Trop de tentatives de connexion. Réessayez plus tard.');
        }

        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();
        $errorMessage = '';

        // Message d'erreur générique pour éviter l'énumération
        if ($error) {
            $errorMessage = 'Identifiants invalides';
        }

        return $this->render('login/index.html.twig', [
            'last_username' => $lastUsername,
            'error' => $errorMessage,
        ]);
    }
}
