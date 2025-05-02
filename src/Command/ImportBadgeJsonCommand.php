<?php

namespace App\Command;

use App\Entity\Badge;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ImportBadgeJsonCommand extends Command
{
    protected static $defaultName = 'app:import-badges-json';

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setName('app:import-badges-json')
            ->setDescription('Imports badges from a JSON file into the database.')
            ->setHelp('This command allows you to import badges from a JSON file into the database.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $filePath = 'public/badges.json';

        // Load the JSON file
        $jsonContent = file_get_contents($filePath);
        $data = json_decode($jsonContent, true);

        foreach ($data as $item) {
            $badge = new Badge();
            $badge->setBadgeNumber($item['badgeNumber']);
            $badge->setSerialNumber($item['serialNumber']);
            $badge->setIdentifiant1($item['Identifiant 1'] ?? '');
            $badge->setIdentifiant2($item['Identifiant 2'] ?? '');
            $badge->setIdentifiant3($item['Identifiant 3'] ?? '');
            $badge->setImmatriculation($item['Immatriculation'] ?? '');
            $badge->setService($item['Service'] ?? '');
            $badge->setAttribution($item['Attribution']);
            

            $this->entityManager->persist($badge);
        }

        $this->entityManager->flush();

        $output->writeln('Vehicles imported successfully!');

        return Command::SUCCESS;
    }
}
