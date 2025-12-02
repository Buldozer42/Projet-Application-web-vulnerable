<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231219101253 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE atelier ADD salle2_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE atelier ADD CONSTRAINT FK_E1BB182392B6761E FOREIGN KEY (salle2_id) REFERENCES salle (id)');
        $this->addSql('CREATE INDEX IDX_E1BB182392B6761E ON atelier (salle2_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE atelier DROP FOREIGN KEY FK_E1BB182392B6761E');
        $this->addSql('DROP INDEX IDX_E1BB182392B6761E ON atelier');
        $this->addSql('ALTER TABLE atelier DROP salle2_id');
    }
}
