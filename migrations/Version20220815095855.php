<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220815095855 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE artworks DROP FOREIGN KEY FK_A2E004C7B7970CF8');
        $this->addSql('DROP INDEX IDX_A2E004C7B7970CF8 ON artworks');
        $this->addSql('ALTER TABLE artworks DROP artist_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE artworks ADD artist_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE artworks ADD CONSTRAINT FK_A2E004C7B7970CF8 FOREIGN KEY (artist_id) REFERENCES artists (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_A2E004C7B7970CF8 ON artworks (artist_id)');
    }
}
