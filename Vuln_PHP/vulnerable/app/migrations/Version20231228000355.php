<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231228000355 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE metier DROP FOREIGN KEY FK_51A00D8C82E2CF35');
        $this->addSql('DROP INDEX IDX_51A00D8C82E2CF35 ON metier');
        $this->addSql('ALTER TABLE metier DROP atelier_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE metier ADD atelier_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE metier ADD CONSTRAINT FK_51A00D8C82E2CF35 FOREIGN KEY (atelier_id) REFERENCES atelier (id)');
        $this->addSql('CREATE INDEX IDX_51A00D8C82E2CF35 ON metier (atelier_id)');
    }
}
