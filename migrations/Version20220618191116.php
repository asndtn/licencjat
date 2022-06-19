<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220618191116 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE inputs ADD author_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE inputs ADD CONSTRAINT FK_361A04EF675F31B FOREIGN KEY (author_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_361A04EF675F31B ON inputs (author_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE inputs DROP FOREIGN KEY FK_361A04EF675F31B');
        $this->addSql('DROP INDEX IDX_361A04EF675F31B ON inputs');
        $this->addSql('ALTER TABLE inputs DROP author_id');
    }
}
