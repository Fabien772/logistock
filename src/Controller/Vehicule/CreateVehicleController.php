<?php

namespace App\Controller\Vehicule;

use App\Entity\Vehicle;
use App\Form\VehicleType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class CreateVehicleController extends AbstractController
{
    #[Route('/vehicule/create', name: 'app_create_vehicle')]
    public function index(Request $request, EntityManagerInterface $entityManager ): Response
    {   $vehicle = new Vehicle();
        $form = $this->createForm(VehicleType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $vehicle = $form->getData();
            // Save the vehicle to the database or perform any other action
            
            $entityManager->persist($vehicle);
            $entityManager->flush();

            $this->addFlash('message', 'Véhicule créé avec succès.');
            return $this->redirectToRoute('app_vehicule');
            
        }

        return $this->render('vehicule/create/create_vehicle.html.twig', [
            'form' => $form->createView(),
        ]);

        
    }
    
    

    #[Route('/vehicule/delete/{id}', name: 'vehicle_delete', methods: ['POST', 'GET'])]
    public function delete(Request $request, EntityManagerInterface $em, $id): Response
    
    {   $vehicle = new Vehicle();
        $vehicle = $em->getRepository(Vehicle::class)->find($id);
        if (!$vehicle) {
            throw $this->createNotFoundException('Véhicule non trouvé.');
        }
        
        // Vérifier s'il y a des réservations associées
        if ($vehicle->getReservations()->count() < 0) {
        
            $this->addFlash('message', 'Impossible de supprimer ce véhicule car il a des réservations associées.');
            
            return $this->redirectToRoute('app_vehicule');
        }
;
       
        // Vérifier le token CSRF pour la sécurité
        
            $em->remove($vehicle);
            $em->flush();
            $this->addFlash('message', 'Véhicule supprimé avec succès.');
            
            
        
        return $this->redirectToRoute('app_vehicule');
        
    }
    
}

    