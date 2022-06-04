<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220603184818 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE inputs ADD artist_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE inputs ADD CONSTRAINT FK_361A04EB7970CF8 FOREIGN KEY (artist_id) REFERENCES artists (id)');
        $this->addSql('CREATE INDEX IDX_361A04EB7970CF8 ON inputs (artist_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE inputs DROP FOREIGN KEY FK_361A04EB7970CF8');
        $this->addSql('DROP INDEX IDX_361A04EB7970CF8 ON inputs');
        $this->addSql('ALTER TABLE inputs DROP artist_id');
    }
}
