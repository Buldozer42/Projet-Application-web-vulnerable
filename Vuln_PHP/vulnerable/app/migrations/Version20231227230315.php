<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231227230315 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE metier_atelier DROP FOREIGN KEY FK_ECDFFF9EED16FA20');
        $this->addSql('ALTER TABLE metier_atelier DROP FOREIGN KEY FK_ECDFFF9E82E2CF35');
        $this->addSql('DROP TABLE metier_atelier');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE metier_atelier (metier_id INT NOT NULL, atelier_id INT NOT NULL, INDEX IDX_ECDFFF9EED16FA20 (metier_id), INDEX IDX_ECDFFF9E82E2CF35 (atelier_id), PRIMARY KEY(metier_id, atelier_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE metier_atelier ADD CONSTRAINT FK_ECDFFF9EED16FA20 FOREIGN KEY (metier_id) REFERENCES metier (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE metier_atelier ADD CONSTRAINT FK_ECDFFF9E82E2CF35 FOREIGN KEY (atelier_id) REFERENCES atelier (id) ON DELETE CASCADE');
    }
}
