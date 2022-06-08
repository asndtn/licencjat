<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220608105400 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE artists (id INT AUTO_INCREMENT NOT NULL, nationality_id INT NOT NULL, name VARCHAR(64) NOT NULL, date_of_birth DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', date_of_death DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_68D3801E1C9DA55 (nationality_id), UNIQUE INDEX uq_artists_name (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categories (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(64) NOT NULL, slug VARCHAR(64) NOT NULL, UNIQUE INDEX uq_categories_name (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fields (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(64) NOT NULL, slug VARCHAR(64) NOT NULL, UNIQUE INDEX uq_fields_name (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE inputs (id INT AUTO_INCREMENT NOT NULL, category_id INT NOT NULL, field_id INT NOT NULL, movement_id INT NOT NULL, artist_id INT NOT NULL, title VARCHAR(180) NOT NULL, description VARCHAR(255) NOT NULL, INDEX IDX_361A04E12469DE2 (category_id), INDEX IDX_361A04E443707B0 (field_id), INDEX IDX_361A04E229E70A7 (movement_id), INDEX IDX_361A04EB7970CF8 (artist_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE movements (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(64) NOT NULL, slug VARCHAR(64) NOT NULL, UNIQUE INDEX uq_movements_name (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE nationalities (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(64) NOT NULL, slug VARCHAR(64) NOT NULL, UNIQUE INDEX uq_nationalities_name (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE artists ADD CONSTRAINT FK_68D3801E1C9DA55 FOREIGN KEY (nationality_id) REFERENCES nationalities (id)');
        $this->addSql('ALTER TABLE inputs ADD CONSTRAINT FK_361A04E12469DE2 FOREIGN KEY (category_id) REFERENCES categories (id)');
        $this->addSql('ALTER TABLE inputs ADD CONSTRAINT FK_361A04E443707B0 FOREIGN KEY (field_id) REFERENCES fields (id)');
        $this->addSql('ALTER TABLE inputs ADD CONSTRAINT FK_361A04E229E70A7 FOREIGN KEY (movement_id) REFERENCES movements (id)');
        $this->addSql('ALTER TABLE inputs ADD CONSTRAINT FK_361A04EB7970CF8 FOREIGN KEY (artist_id) REFERENCES artists (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE inputs DROP FOREIGN KEY FK_361A04EB7970CF8');
        $this->addSql('ALTER TABLE inputs DROP FOREIGN KEY FK_361A04E12469DE2');
        $this->addSql('ALTER TABLE inputs DROP FOREIGN KEY FK_361A04E443707B0');
        $this->addSql('ALTER TABLE inputs DROP FOREIGN KEY FK_361A04E229E70A7');
        $this->addSql('ALTER TABLE artists DROP FOREIGN KEY FK_68D3801E1C9DA55');
        $this->addSql('DROP TABLE artists');
        $this->addSql('DROP TABLE categories');
        $this->addSql('DROP TABLE fields');
        $this->addSql('DROP TABLE inputs');
        $this->addSql('DROP TABLE movements');
        $this->addSql('DROP TABLE nationalities');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
