<?php

namespace App\Controller\Vehicule;

use App\Entity\Vehicle;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class VehiculeController extends AbstractController
{
    #[Route('/vehicule', name: 'app_vehicule')]
    public function index(EntityManagerInterface $em): Response
    {   $vehicles = new Vehicle();
        $vehicles = $em->getRepository(vehicle::class)->findAll();
        
        return $this->render('vehicule/index.html.twig', [
            'vehicles' => $vehicles,
        ]);
    }

    
}
