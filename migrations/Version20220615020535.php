<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220615020535 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE inputs_tags (input_id INT NOT NULL, tag_id INT NOT NULL, INDEX IDX_FA09E9C436421AD6 (input_id), INDEX IDX_FA09E9C4BAD26311 (tag_id), PRIMARY KEY(input_id, tag_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE inputs_tags ADD CONSTRAINT FK_FA09E9C436421AD6 FOREIGN KEY (input_id) REFERENCES inputs (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE inputs_tags ADD CONSTRAINT FK_FA09E9C4BAD26311 FOREIGN KEY (tag_id) REFERENCES tags (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE tasks_tags');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE tasks_tags (input_id INT NOT NULL, tag_id INT NOT NULL, INDEX IDX_85533A5036421AD6 (input_id), INDEX IDX_85533A50BAD26311 (tag_id), PRIMARY KEY(input_id, tag_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE tasks_tags ADD CONSTRAINT FK_85533A5036421AD6 FOREIGN KEY (input_id) REFERENCES inputs (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tasks_tags ADD CONSTRAINT FK_85533A50BAD26311 FOREIGN KEY (tag_id) REFERENCES tags (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('DROP TABLE inputs_tags');
    }
}
