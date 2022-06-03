<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220603004313 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE inputs ADD movement_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE inputs ADD CONSTRAINT FK_361A04E229E70A7 FOREIGN KEY (movement_id) REFERENCES movements (id)');
        $this->addSql('CREATE INDEX IDX_361A04E229E70A7 ON inputs (movement_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE inputs DROP FOREIGN KEY FK_361A04E229E70A7');
        $this->addSql('DROP INDEX IDX_361A04E229E70A7 ON inputs');
        $this->addSql('ALTER TABLE inputs DROP movement_id');
    }
}
