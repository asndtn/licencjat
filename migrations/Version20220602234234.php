<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220602234234 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE inputs CHANGE field_id field_id INT NOT NULL');
        $this->addSql('ALTER TABLE inputs ADD CONSTRAINT FK_361A04E12469DE2 FOREIGN KEY (category_id) REFERENCES categories (id)');
        $this->addSql('ALTER TABLE inputs ADD CONSTRAINT FK_361A04E443707B0 FOREIGN KEY (field_id) REFERENCES fields (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE inputs DROP FOREIGN KEY FK_361A04E12469DE2');
        $this->addSql('ALTER TABLE inputs DROP FOREIGN KEY FK_361A04E443707B0');
        $this->addSql('ALTER TABLE inputs CHANGE field_id field_id INT DEFAULT NULL');
    }
}
