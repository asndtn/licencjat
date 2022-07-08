<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220703200539 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fields DROP slug');
        $this->addSql('ALTER TABLE fields RENAME INDEX suq_fields_name TO uq_fields_name');
        $this->addSql('ALTER TABLE inputs DROP FOREIGN KEY FK_361A04EB7970CF8');
        $this->addSql('ALTER TABLE inputs DROP FOREIGN KEY FK_361A04EF675F31B');
        $this->addSql('DROP INDEX IDX_361A04EB7970CF8 ON inputs');
        $this->addSql('DROP INDEX IDX_361A04EF675F31B ON inputs');
        $this->addSql('ALTER TABLE inputs DROP artist_id, DROP author_id');
        $this->addSql('ALTER TABLE movements DROP slug');
        $this->addSql('ALTER TABLE movements RENAME INDEX uq_movements_name TO uq_movement_name');
        $this->addSql('DROP INDEX uq_nationalities_name ON nationalities');
        $this->addSql('ALTER TABLE nationalities DROP slug');
        $this->addSql('DROP INDEX uq_tags_name ON tags');
        $this->addSql('ALTER TABLE tags DROP slug');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fields ADD slug VARCHAR(64) NOT NULL');
        $this->addSql('ALTER TABLE fields RENAME INDEX uq_fields_name TO suq_fields_name');
        $this->addSql('ALTER TABLE inputs ADD artist_id INT NOT NULL, ADD author_id INT NOT NULL');
        $this->addSql('ALTER TABLE inputs ADD CONSTRAINT FK_361A04EB7970CF8 FOREIGN KEY (artist_id) REFERENCES artists (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE inputs ADD CONSTRAINT FK_361A04EF675F31B FOREIGN KEY (author_id) REFERENCES users (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_361A04EB7970CF8 ON inputs (artist_id)');
        $this->addSql('CREATE INDEX IDX_361A04EF675F31B ON inputs (author_id)');
        $this->addSql('ALTER TABLE movements ADD slug VARCHAR(64) NOT NULL');
        $this->addSql('ALTER TABLE movements RENAME INDEX uq_movement_name TO uq_movements_name');
        $this->addSql('ALTER TABLE nationalities ADD slug VARCHAR(64) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX uq_nationalities_name ON nationalities (name)');
        $this->addSql('ALTER TABLE tags ADD slug VARCHAR(64) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX uq_tags_name ON tags (name)');
    }
}
