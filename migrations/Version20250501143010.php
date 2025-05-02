<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250501143010 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE visa_card (id INT AUTO_INCREMENT NOT NULL, identifiant VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, alias VARCHAR(255) DEFAULT NULL, immatriculation VARCHAR(255) DEFAULT NULL, desactived TINYINT(1) NOT NULL, status VARCHAR(255) NOT NULL, date_attrib DATE DEFAULT NULL, activated_on DATE DEFAULT NULL, archiving_date DATE DEFAULT NULL, comment VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            DROP TABLE visa_card
        SQL);
    }
}
