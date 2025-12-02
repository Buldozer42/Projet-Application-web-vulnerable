<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231228000423 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE atelier_metier (atelier_id INT NOT NULL, metier_id INT NOT NULL, INDEX IDX_B09756A082E2CF35 (atelier_id), INDEX IDX_B09756A0ED16FA20 (metier_id), PRIMARY KEY(atelier_id, metier_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE atelier_metier ADD CONSTRAINT FK_B09756A082E2CF35 FOREIGN KEY (atelier_id) REFERENCES atelier (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE atelier_metier ADD CONSTRAINT FK_B09756A0ED16FA20 FOREIGN KEY (metier_id) REFERENCES metier (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE atelier_metier DROP FOREIGN KEY FK_B09756A082E2CF35');
        $this->addSql('ALTER TABLE atelier_metier DROP FOREIGN KEY FK_B09756A0ED16FA20');
        $this->addSql('DROP TABLE atelier_metier');
    }
}
