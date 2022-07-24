<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220722193017 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE artists CHANGE nationality_id nationality_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE inputs CHANGE field_id field_id INT DEFAULT NULL, CHANGE movement_id movement_id INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE artists CHANGE nationality_id nationality_id INT NOT NULL');
        $this->addSql('ALTER TABLE inputs CHANGE field_id field_id INT NOT NULL, CHANGE movement_id movement_id INT NOT NULL');
    }
}
