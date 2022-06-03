<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220602232837 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE inputs ADD field_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE inputs ADD CONSTRAINT FK_361A04E443707B0 FOREIGN KEY (field_id) REFERENCES fields (id)');
        $this->addSql('CREATE INDEX IDX_361A04E443707B0 ON inputs (field_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE inputs DROP FOREIGN KEY FK_361A04E443707B0');
        $this->addSql('DROP INDEX IDX_361A04E443707B0 ON inputs');
        $this->addSql('ALTER TABLE inputs DROP field_id');
    }
}
