<?php

namespace App\Command;

use App\Entity\Vehicle;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ImportVehiclesJsonCommand extends Command
{
    protected static $defaultName = 'app:import-vehicles-json';

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setName('app:import-vehicles-json')
            ->setDescription('Imports vehicles from a JSON file into the database.')
            ->setHelp('This command allows you to import vehicles from a JSON file into the database.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $filePath = 'public/parc2025.json';

        // Load the JSON file
        $jsonContent = file_get_contents($filePath);
        $data = json_decode($jsonContent, true);

        foreach ($data as $item) {
            $vehicle = new Vehicle();
            $vehicle->setMarque("");
            $vehicle->setImmat($item['IMMAT']);
            $vehicle->setModele($item['Model'] ?? '');
            $vehicle->setDateAcquisition(new \DateTime(str_replace('/', '-', $item['Date acquisition'])));
            $vehicle->setAttribution($item['ATTRIBUTION']);
            $vehicle->setnumeroPlace($item['PLACE']);
            $vehicle->setEquipementPolice($item['Equipement police'] === 'oui' ? true : false);
            $vehicle->setComment($item['Commentaire']);
            $vehicle->setPret($item['PRET'] === 'oui' ? true : false);
            $vehicle->setSituation($item['SITUATION']);

            $this->entityManager->persist($vehicle);
        }

        $this->entityManager->flush();

        $output->writeln('Vehicles imported successfully!');

        return Command::SUCCESS;
    }
}
