<?php

namespace App\Controller\Vehicule;

use App\Entity\Vehicle;
use App\Form\VehicleType;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\ORM\EntityManagerInterface;

final class VehiculeController extends AbstractController
{
    #[Route('/vehicule', name: 'app_vehicle')]
    public function index(EntityManagerInterface $em): Response
    {
        $vehicles = new Vehicle();
        $vehicles = $em->getRepository(vehicle::class)->findAll();

        return $this->render('vehicule/vehicles.html.twig', [
            'vehicles' => $vehicles,
            'titre' => "Parc automobile",
            'create_vehicle' => "Créer un véhicule",
        ]);
    }

    #[Route('/vehicule/create', name: 'app_create_vehicle', methods: ['POST', 'GET'])]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $vehicle = new Vehicle();
        $form = $this->createForm(VehicleType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $vehicle = $form->getData();


            // Save the vehicle to the database or perform any other action

            $entityManager->persist($vehicle);
            $entityManager->flush();

            $this->addFlash('message', 'Véhicule créé avec succès.');
            return $this->redirectToRoute('app_vehicle',['titre'=> "Parc automobile"]);
        }

        return $this->render('vehicule/create_vehicle.html.twig', [
            'form' => $form->createView(),
            'titre' => "Création d'un véhicule"
        ]);
    }

    #[Route('/vehicule/edit/{id}', name: 'app_edit_vehicle', methods: ['POST', 'GET'])]
    public function edit(Request $request, EntityManagerInterface $em, $id): Response
    {
        $vehicle = new Vehicle();
        $vehicle = $em->getRepository(Vehicle::class)->find($id);


        $form = $this->createForm(VehicleType::class, $vehicle);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {



            // Save the vehicle to the database or perform any other action

            $em->persist($vehicle);
            $em->flush();

            $this->addFlash('message', 'Véhicule modifié avec succès.');
            return $this->redirectToRoute('app_vehicle');
        }

        return $this->render('vehicule/edit_vehicle.html.twig', [
            'form' => $form->createView(),
            'vehicle' => $vehicle,
            'titre' => "Modification d'un véhicule"
        ]);
    }



    #[Route('/vehicule/delete/{id}', name: 'vehicle_delete', methods: ['POST', 'GET'])]
    public function delete(Request $request, EntityManagerInterface $em, $id): Response

    {
        $vehicle = new Vehicle();
        $vehicle = $em->getRepository(Vehicle::class)->find($id);
        if (!$vehicle) {
            throw $this->createNotFoundException('Véhicule non trouvé.');
        }

        // Vérifier s'il y a des réservations associées
        if ($vehicle->getReservations()->count() < 0) {

            $this->addFlash('message', 'Impossible de supprimer ce véhicule car il a des réservations associées.');

            return $this->redirectToRoute('app_vehicle', ['titre' => "Parc automobile"]);
        }

        $em->remove($vehicle);
        $em->flush();
        $this->addFlash('message', 'Véhicule supprimé avec succès.');



        return $this->redirectToRoute('app_vehicle',['titre'=> "Parc automobile"]);
    }

    // Confirmation de suppression du véhicule

    // #[Route('/vehicule/delete/confirm-delete/{id}', name: 'vehicle_confirm_delete', methods: ['POST', 'GET'])]
    // public function confirmDelete(Vehicle $vehicle): Response
    // {
    //     return $this->render('vehicule/confirm_delete_vehicle.html.twig', [
    //         'vehicle' => $vehicle,
    //     ]);
    // }
}
