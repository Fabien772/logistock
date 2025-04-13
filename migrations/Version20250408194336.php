<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250408194336 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE reservation (id INT AUTO_INCREMENT NOT NULL, vehicle_id INT DEFAULT NULL, start_date DATETIME NOT NULL, end_date DATETIME NOT NULL, customer_name VARCHAR(255) NOT NULL, INDEX IDX_42C84955545317D1 (vehicle_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE vehicle (id INT AUTO_INCREMENT NOT NULL, marque VARCHAR(255) NOT NULL, immat VARCHAR(255) NOT NULL, modele VARCHAR(255) NOT NULL, attribution VARCHAR(255) DEFAULT NULL, numero_place INT DEFAULT NULL, equipement_police TINYINT(1) NOT NULL, pret TINYINT(1) NOT NULL, situation VARCHAR(255) DEFAULT NULL, comment VARCHAR(255) DEFAULT NULL, date_acquisition DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE reservation ADD CONSTRAINT FK_42C84955545317D1 FOREIGN KEY (vehicle_id) REFERENCES vehicle (id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955545317D1
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE reservation
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE vehicle
        SQL);
    }
}
