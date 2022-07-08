<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220707193203 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE artists ADD CONSTRAINT FK_68D3801E1C9DA55 FOREIGN KEY (nationality_id) REFERENCES nationalities (id)');
        $this->addSql('ALTER TABLE inputs ADD CONSTRAINT FK_361A04E12469DE2 FOREIGN KEY (category_id) REFERENCES categories (id)');
        $this->addSql('ALTER TABLE inputs ADD CONSTRAINT FK_361A04E443707B0 FOREIGN KEY (field_id) REFERENCES fields (id)');
        $this->addSql('ALTER TABLE inputs ADD CONSTRAINT FK_361A04E229E70A7 FOREIGN KEY (movement_id) REFERENCES movements (id)');
        $this->addSql('ALTER TABLE inputs ADD CONSTRAINT FK_361A04EB7970CF8 FOREIGN KEY (artist_id) REFERENCES artists (id)');
        $this->addSql('ALTER TABLE inputs ADD CONSTRAINT FK_361A04EF675F31B FOREIGN KEY (author_id) REFERENCES users (id)');
        $this->addSql('CREATE INDEX IDX_361A04EB7970CF8 ON inputs (artist_id)');
        $this->addSql('CREATE INDEX IDX_361A04EF675F31B ON inputs (author_id)');
        $this->addSql('ALTER TABLE inputs_tags ADD CONSTRAINT FK_FA09E9C436421AD6 FOREIGN KEY (input_id) REFERENCES inputs (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE inputs_tags ADD CONSTRAINT FK_FA09E9C4BAD26311 FOREIGN KEY (tag_id) REFERENCES tags (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE artists DROP FOREIGN KEY FK_68D3801E1C9DA55');
        $this->addSql('ALTER TABLE inputs DROP FOREIGN KEY FK_361A04E12469DE2');
        $this->addSql('ALTER TABLE inputs DROP FOREIGN KEY FK_361A04E443707B0');
        $this->addSql('ALTER TABLE inputs DROP FOREIGN KEY FK_361A04E229E70A7');
        $this->addSql('ALTER TABLE inputs DROP FOREIGN KEY FK_361A04EB7970CF8');
        $this->addSql('ALTER TABLE inputs DROP FOREIGN KEY FK_361A04EF675F31B');
        $this->addSql('DROP INDEX IDX_361A04EB7970CF8 ON inputs');
        $this->addSql('DROP INDEX IDX_361A04EF675F31B ON inputs');
        $this->addSql('ALTER TABLE inputs_tags DROP FOREIGN KEY FK_FA09E9C436421AD6');
        $this->addSql('ALTER TABLE inputs_tags DROP FOREIGN KEY FK_FA09E9C4BAD26311');
    }
}
