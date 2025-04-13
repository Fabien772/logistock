<?php

namespace App\Controller\Vehicule;

use App\Entity\Vehicle;
use App\Entity\Reservation;
use App\Form\ReservationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

final class ReservationController extends AbstractController
{



    #[Route('vehicule/reservation', name: 'reservation_index')]
    public function index( EntityManagerInterface $em): Response
    {
        $vehicles = $em->getRepository(Vehicle::class)->findAll();
        $reservations = $em->getRepository(Reservation::class)->findAll();
        
        return $this->render('vehicule/reservation/index.html.twig', [
            'vehicles' => $vehicles,
            'reservations' => $reservations,
        ]);
    }

    #[Route('vehicule/reservation/new', name: 'reservation_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $reservation = new Reservation();
        $form = $this->createForm(ReservationType::class, $reservation);
        
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            // Vérifier que la date de fin est après la date de début
            if ($reservation->getEndDate() <= $reservation->getStartDate()) {
                $this->addFlash('error', 'La date de fin doit être après la date de début.');
                return $this->redirectToRoute('reservation_new');
            }
            
            // Vérifier la disponibilité du véhicule
            if ($this->isVehicleAvailable($reservation->getVehicle(), $reservation->getStartDate(), $reservation->getEndDate(), $em)) {
                $em->persist($reservation);
                $em->flush();
                $this->addFlash('success', 'Réservation créée avec succès.');
                return $this->redirectToRoute('reservation_index');
            } else {
                $this->addFlash('error', 'Le véhicule n\'est pas disponible pour cette période.');
            }
        }
        
        return $this->render('vehicule/reservation/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    
    private function isVehicleAvailable(Vehicle $vehicle, \DateTimeInterface $startDate, \DateTimeInterface $endDate, EntityManagerInterface $em): bool
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
}
   

