<?php

namespace App\Controller;

use App\Repository\AtelierRepository;
use App\Repository\InscriptionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\ImageType;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Doctrine\ORM\EntityManagerInterface;

class UserProfileController extends AbstractController
{
    #[Route('/student/user-profile/{id}', name: 'user-profile')]

    public function index(
        InscriptionRepository $inscriptionRepository, 
        $id, 
        Request $request, 
        #[Autowire('%kernel.project_dir%/public/uploads/images')] string $imagesDirectory,
        EntityManagerInterface $em
    ): Response
    {
        $inscription = $inscriptionRepository->find($id);

        if (!$inscription) {
            throw $this->createNotFoundException("L'inscription n'a pas été trouvé.");
        }

        $form = $this->createForm(ImageType::class);
        $form->handleRequest($request);
        
        $originalFilename = $request->cookies->get('image');

        if ($form->isSubmitted() && $form->isValid()) {
            $imageFile = $form->get('image')->getData();

            $originalFilename = 'image.' . $imageFile->getClientOriginalExtension();

            $this->getUser()->setImageFilename($originalFilename);

            try {
                $imageFile->move($imagesDirectory, $originalFilename);
            } catch (FileException $e) {
                // ... handle exception if something happens during file upload
            }

            $em->flush();

            return $this->redirectToRoute('user-profile', ['id' => $inscription->getId()]);
        }

        return $this->render('user-profile/index.html.twig', [
            'inscription' => $inscription,
            'form' => $form,
        ]);
    }

}
