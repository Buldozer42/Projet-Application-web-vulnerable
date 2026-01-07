<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\RateLimiter\RateLimiterFactory;
use Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException;
use Symfony\Component\DependencyInjection\Attribute\Autowire;

class RegistrationController extends AbstractController
{

    public function __construct(
        #[Autowire(service: 'limiter.registerLimiter')] private RateLimiterFactory $registerLimiter
    ) {}

    /**
     * @throws TransportExceptionInterface
     */
    #[Route('/register', name: 'app_register')]
    public function register(
        Request $request, 
        UserPasswordHasherInterface $userPasswordHasher, 
        EntityManagerInterface $entityManager, 
        MailerInterface $mailer
    ): Response {
        // Limiter les tentatives d'inscription par IP
        $limiter = $this->registerLimiter->create($request->getClientIp());
        
        if (false === $limiter->consume(1)->isAccepted()) {
            throw new TooManyRequestsHttpException('Trop de tentatives d\'inscription. Réessayez plus tard.');
        }

        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Hash le mot de passe avant de le stocker
            $hashedPassword = $userPasswordHasher->hashPassword(
                $user,
                $form->get('plainPassword')->getData()
            );
            $user->setPassword($hashedPassword);

            $user->setRoles(['ROLE_STUDENT']);

            try {
                $entityManager->persist($user);
                $entityManager->flush();

                // Tentative d'envoi de l'email de confirmation (commentée car aucun mailer n'est fonctionnel dans l'application)

                // try {
                //     $mailer->send(
                //         (new TemplatedEmail())
                //             ->from(new Address('esgi.symfony@tp.com', 'Mail'))
                //             ->to($user->getEmail())
                //             ->subject('Bienvenue sur le site!')
                //             ->htmlTemplate('registration/confirmation_email.html.twig')
                //     );
                //     $this->addFlash('success', 'Inscription réussie! Veuillez vérifier votre email pour confirmer votre compte.');
                // } catch (\Exception $e) {
                //     $this->addFlash('warning', 'Inscription réussie mais l\'email n\'a pas pu être envoyé.');
                // }

                // Message de succès après inscription
                $this->addFlash('success', 'Inscription réussie! Vous pouvez maintenant vous connecter.');
                return $this->redirectToRoute('app_login');
            } catch (\Exception $e) {
                $this->addFlash('danger', 'Une erreur est survenue lors de l\'inscription.');
            }
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
