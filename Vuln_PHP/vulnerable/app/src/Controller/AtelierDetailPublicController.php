<?php

namespace App\Controller;

use App\Repository\AtelierRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AtelierDetailPublicController extends AbstractController
{
    #[Route('/detail-atelier/{id}', name: 'detail-atelier')]

    public function index(AtelierRepository $atelierRepository, $id): Response
    {
        $atelier = $atelierRepository->find($id);

        if (!$atelier) {
            throw $this->createNotFoundException("'L'atelier n'a pas été trouvé.'");
        }

        return $this->render('front/detail-atelier.html.twig', [
            'atelier' => $atelier,
        ]);
    }

}
