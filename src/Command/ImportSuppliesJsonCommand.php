<?php

namespace App\Command;

use App\Entity\Supplies;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ImportSuppliesJsonCommand extends Command
{
    protected static $defaultName = 'app:ImportSuppliesJsonCommand';

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setName('app:ImportSuppliesJsonCommand')
            ->setDescription('Imports supplies from a JSON file into the database.')
            ->setHelp('This command allows you to import supplies from a JSON file into the database.');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $filePath = 'public/fourniture2025.json';

        // Load the JSON file
        $jsonContent = file_get_contents($filePath);
        $data = json_decode($jsonContent, true);

        foreach ($data as $item) {
            $supplies = new Supplies();
            $supplies->setReference($item['REFERENCE'] ?? 0);
            $supplies->setTypeSupplies($item['TYPE FOURNITURE'] ?? '');
            $supplies->setMarque($item['MARQUE'] ?? '');
            $supplies->setQuantityCommand($item['QUANTITE SOUHAITEE'] ?? null);
            $supplies->setQuantityTotal($item['QTOTAL'] ?? null);

            $this->entityManager->persist($supplies);
        }

        $this->entityManager->flush();

        $output->writeln('Supplies imported successfully!');

        return Command::SUCCESS;
    }
}
