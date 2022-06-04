<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220604151457 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE artists ADD nationality_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE artists ADD CONSTRAINT FK_68D3801E1C9DA55 FOREIGN KEY (nationality_id) REFERENCES nationalities (id)');
        $this->addSql('CREATE INDEX IDX_68D3801E1C9DA55 ON artists (nationality_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE artists DROP FOREIGN KEY FK_68D3801E1C9DA55');
        $this->addSql('DROP INDEX IDX_68D3801E1C9DA55 ON artists');
        $this->addSql('ALTER TABLE artists DROP nationality_id');
    }
}
