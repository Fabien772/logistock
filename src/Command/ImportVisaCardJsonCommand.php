<?php

namespace App\Command;

use App\Entity\Badge;
use App\Entity\VisaCard;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ImportVisaCardJsonCommand extends Command
{
    protected static $defaultName = 'app:import-visa-card-json';

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setName('app:import-visa-card-json')
            ->setDescription('Imports visa cards from a JSON file into the database.')
            ->setHelp('This command allows you to import visa cards from a JSON file into the database.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $filePath = 'public/mooncard.json';

        // Load the JSON file
        $jsonContent = file_get_contents($filePath);
        $data = json_decode($jsonContent, true);

        foreach ($data as $item) {
            $visaCard = new VisaCard();
            $visaCard->setIdentifiant($item['Identifiant'] ?? null);
            $visaCard->setName($item['Name'] ?? null);
            $visaCard->setAlias($item['Alias'] ?? null);
            $chaine = !empty($item['Immatriculation']) ? $item['Immatriculation'] : null;
            $partie1 = substr($chaine, 0, 2); // Les 2 premiers caractères
            $partie2 = substr($chaine, 2, 3); // Les 3 caractères suivants
            $partie3 = substr($chaine, 5, 2); // Les 2 derniers caractères
            if ($chaine != null) {
                $visaCard->setImmatriculation($partie1 . '-' . $partie2 . '-' . $partie3);
            }
            $visaCard->setDesactived($item['desactived'] ?? false);
            $status = $item['Status'] === "Activée" ? $item['Status'] : "";
            $visaCard->setStatus($status);

            // Conversion des dates avec validation
            $dateAttrib = !empty($item['Attribution']) ? \DateTime::createFromFormat('d/m/y', $item['Attribution']) : null;
            $dateActivated = !empty($item['Activated on']) ? \DateTime::createFromFormat('d/m/y', $item['Activated on']) : null;
            $dateArchiving = !empty($item['Archiving date']) ? \DateTime::createFromFormat('d/m/y', $item['Archiving date']) : null;

            $visaCard->setDateAttrib($dateAttrib);
            $visaCard->setActivatedOn($dateActivated);
            $visaCard->setArchivingDate($dateArchiving);
            $visaCard->setComment($item['Raison de la désactivation'] ?? null);

            $this->entityManager->persist($visaCard);
        }

        $this->entityManager->flush();

        $output->writeln('Vehicles imported successfully!');

        return Command::SUCCESS;
    }
}
