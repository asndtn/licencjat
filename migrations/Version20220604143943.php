<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220604143943 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE nationalities (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(64) NOT NULL, UNIQUE INDEX uq_nationalities_name (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE artists CHANGE date_of_birth date_of_birth DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE date_of_death date_of_death DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE nationalities');
        $this->addSql('ALTER TABLE artists CHANGE date_of_birth date_of_birth DATE NOT NULL, CHANGE date_of_death date_of_death DATE DEFAULT NULL');
    }
}
