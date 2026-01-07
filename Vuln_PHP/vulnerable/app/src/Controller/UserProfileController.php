<?php

namespace App\Controller;

use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
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
        int $id, 
        Request $request, 
        #[Autowire('%kernel.project_dir%/public/uploads/images')] string $imagesDirectory,
        EntityManagerInterface $em,
        SluggerInterface $slugger
    ): Response
    {
        $inscription = $inscriptionRepository->find($id);

        // Vérification de l'accès
        if (!$inscription || $inscription->getUser() !== $this->getUser()) {
            throw $this->createAccessDeniedException();
        }

        $form = $this->createForm(ImageType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imageFile = $form->get('image')->getData();

            if ($imageFile) {
                // Validation de l'extension
                $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                $extension = strtolower($imageFile->guessExtension());
                
                if (!in_array($extension, $allowedExtensions)) {
                    $this->addFlash('danger', 'Format de fichier non autorisé. Utilisez JPG, PNG, GIF ou WebP.');
                    return $this->redirectToRoute('user-profile', ['id' => $inscription->getId()]);
                }

                // Validation du type MIME
                $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
                if (!in_array($imageFile->getMimeType(), $allowedMimeTypes)) {
                    $this->addFlash('danger', 'Type MIME non autorisé.');
                    return $this->redirectToRoute('user-profile', ['id' => $inscription->getId()]);
                }

                // Vérification des magic bytes (signature réelle du fichier)
                $finfo = finfo_open(FILEINFO_MIME_TYPE);
                $realMimeType = finfo_file($finfo, $imageFile->getPathname());
                finfo_close($finfo);

                $validMagicBytes = [
                    'image/jpeg' => true,
                    'image/png' => true,
                    'image/gif' => true,
                    'image/webp' => true
                ];

                if (!isset($validMagicBytes[$realMimeType])) {
                    $this->addFlash('danger', 'Le contenu du fichier ne correspond pas à une image valide.');
                    return $this->redirectToRoute('user-profile', ['id' => $inscription->getId()]);
                }

                // Validation de la taille (max 5 Mo)
                $maxSize = 5 * 1024 * 1024; // 5 Mo en octets
                if ($imageFile->getSize() > $maxSize) {
                    $this->addFlash('danger', 'Le fichier est trop volumineux. Taille maximale : 5 Mo.');
                    return $this->redirectToRoute('user-profile', ['id' => $inscription->getId()]);
                }

                // Génération d'un nom de fichier unique et sécurisé
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $extension;

                // Suppression de l'ancienne image si elle existe
                $oldImage = $this->getUser()->getImageFilename();
                if ($oldImage) {
                    $oldImagePath = "$imagesDirectory/$oldImage";
                    if (file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                }

                try {
                    // Déplacement du fichier
                    $imageFile->move($imagesDirectory, $newFilename);
                    
                    // Mise à jour en base de données
                    $this->getUser()->setImageFilename($newFilename);
                    $em->flush();

                    $this->addFlash('success', 'Image de profil mise à jour avec succès.');
                } catch (FileException $e) {
                    $this->addFlash('danger', 'Une erreur est survenue lors de l\'upload du fichier.');
                }
            }

            return $this->redirectToRoute('user-profile', ['id' => $inscription->getId()]);
        }

        return $this->render('user-profile/index.html.twig', [
            'inscription' => $inscription,
            'form' => $form,
        ]);
    }
}
