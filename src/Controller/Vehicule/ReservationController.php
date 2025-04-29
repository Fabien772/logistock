<?php

namespace App\Controller\Vehicule;

use App\Entity\Vehicle;
use App\Entity\Reservation;
use App\Form\ReservationType;
use App\Repository\VehicleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class ReservationController extends AbstractController
{



    #[Route('vehicule/reservation', name: 'reservation_index')]
    public function index( EntityManagerInterface $em, ): Response
    {
        $vehicles = $em->getRepository(Vehicle::class)->findAll();
        $reservations = $em->getRepository(Reservation::class)->findAll();
        
        
        return $this->render('vehicule/reservation/reservation.html.twig', [
            'vehicles' => $vehicles,
            'reservations' => $reservations,
            'titre' => 'Réservations de véhicules',
        ]);
    }

    #[Route('vehicule/reservation/new', name: 'reservation_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $em, VehicleRepository $vehicleRepository): Response
    {
        $reservation = new Reservation();
        // Récupérer les véhicules disponibles
        $vehicleAPretAvailable = $vehicleRepository->findAvailablePretVehicle();
        // creatform en passant en option les véhicules disponibles
        $form = $this->createForm(ReservationType::class, $reservation,['vehiclesAvailable' => $vehicleAPretAvailable,]);
        
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {

           
            
            // Vérifier que la date de fin est après la date de début
            if ($reservation->getEndDate() <= $reservation->getStartDate()) {
                $this->addFlash('error', 'La date de fin doit être après la date de début.');
                return $this->redirectToRoute('reservation_new');
            }
            
            // Vérifier la disponibilité du véhicule
            if ($this->isVehicleReservationAvailable($reservation->getVehicle(), $reservation->getStartDate(), $reservation->getEndDate(), $em)) {
                $em->persist($reservation);
                $em->flush();
                $this->addFlash('message', 'Réservation créée avec succès.');
                return $this->redirectToRoute('reservation_index');
            } else {
                $this->addFlash('error', 'Le véhicule n\'est pas disponible pour cette période.');
            }
        }
       
            
        
           
        
        return $this->render('vehicule/reservation/new.html.twig', [
            'form' => $form->createView(),
            'titre' => 'Nouvelle réservation',
        ]);
    }
    
    #[Route('vehicule/reservation/edit', name: 'reservation_edit', methods: ['GET', 'POST'])]
    public function edit( EntityManagerInterface $em, Request $request): Response
    {
       
        $reservations = $em->getRepository(Reservation::class)->findAll();
        
        
        return $this->render('vehicule/reservation/edit_reservation.html.twig', [
            'reservations' => $reservations,
            'titre' => 'Modification de réservation',
            
        ]);
    }

    private function isVehicleReservationAvailable(Vehicle $vehicle, \DateTimeInterface $startDate, \DateTimeInterface $endDate, EntityManagerInterface $em): bool
    {
        $conflictingReservations = $em->getRepository(Reservation::class)
            ->createQueryBuilder('r')
            ->where('r.vehicle = :vehicle')
            ->andWhere('r.startDate < :endDate AND r.endDate > :startDate')
            ->setParameter('vehicle', $vehicle)
            ->setParameter('startDate', $startDate)
            ->setParameter('endDate', $endDate)
            ->getQuery()
            ->getResult();
            
        return count($conflictingReservations) === 0;
        
        
    }

    #[Route('vehicule/reservation/delete/{id}', name: 'reservation_delete', methods: ['GET'])]
    public function delete( EntityManagerInterface $em, $id): Response
    {
        $reservation = $em->getRepository(Reservation::class)->find($id);
        if (!$reservation) {
            throw $this->createNotFoundException('Réservation non trouvée.');
        }
        
        $em->remove($reservation);
        $em->flush();
        $this->addFlash('message', 'Réservation supprimée avec succès.');
        
        return $this->redirectToRoute('reservation_index');


        
            
        
    }
    #[Route('vehicule/reservation/modify/{id}', name: 'reservation_modify', methods: ['GET', 'POST'])]
    public function modify( Request $request, Reservation $reservation, VehicleRepository $vehicleRepository, EntityManagerInterface $em,$id): Response
    {
        
      
       
        // Récupérer les véhicules disponibles
        $vehiclePretAvailable = $vehicleRepository->findAvailablePretVehicle();
        // creatform en passant en option les véhicules disponibles
        $form = $this->createForm(ReservationType::class, $reservation,['vehiclesAvailable' => $vehiclePretAvailable,]);
        
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
          
           
            // Vérifier que la date de fin est après la date de début
            if ($reservation->getEndDate() <= $reservation->getStartDate()) {
                $this->addFlash('error', 'La date de fin doit être après la date de début.');
                return $this->redirectToRoute('reservation_modify', ['id' => $reservation->getId()]);
            }
            // dd($this->isVehicleReservationAvailable($reservation->getVehicle(), $reservation->getStartDate(), $reservation->getEndDate(), $em));

            // Vérifier la disponibilité du véhicule
            if ($this->isVehicleReservationAvailable($reservation->getVehicle(), $reservation->getStartDate(), $reservation->getEndDate(), $em)) {
                $em->persist($reservation);
                $em->flush();
                $this->addFlash('message', 'Réservation créée avec succès.');
                return $this->redirectToRoute('reservation_index');
            } else {
                $this->addFlash('error', 'Le véhicule n\'est pas disponible pour cette période.');
            }
        }
        
        
        return $this->render('vehicule/reservation/modify_reservation.html.twig', [
            'form' => $form->createView(),
            'titre' => 'Modification de la réservation',
            
        ]);


        
            
        
    }
}
   

