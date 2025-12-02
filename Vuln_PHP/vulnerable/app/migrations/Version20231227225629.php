<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231227225629 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE metier_competence (metier_id INT NOT NULL, competence_id INT NOT NULL, INDEX IDX_2B2C55BED16FA20 (metier_id), INDEX IDX_2B2C55B15761DAB (competence_id), PRIMARY KEY(metier_id, competence_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE metier_activite (metier_id INT NOT NULL, activite_id INT NOT NULL, INDEX IDX_DA8FEC3ED16FA20 (metier_id), INDEX IDX_DA8FEC39B0F88B1 (activite_id), PRIMARY KEY(metier_id, activite_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE metier_atelier (metier_id INT NOT NULL, atelier_id INT NOT NULL, INDEX IDX_ECDFFF9EED16FA20 (metier_id), INDEX IDX_ECDFFF9E82E2CF35 (atelier_id), PRIMARY KEY(metier_id, atelier_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE metier_competence ADD CONSTRAINT FK_2B2C55BED16FA20 FOREIGN KEY (metier_id) REFERENCES metier (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE metier_competence ADD CONSTRAINT FK_2B2C55B15761DAB FOREIGN KEY (competence_id) REFERENCES competence (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE metier_activite ADD CONSTRAINT FK_DA8FEC3ED16FA20 FOREIGN KEY (metier_id) REFERENCES metier (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE metier_activite ADD CONSTRAINT FK_DA8FEC39B0F88B1 FOREIGN KEY (activite_id) REFERENCES activite (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE metier_atelier ADD CONSTRAINT FK_ECDFFF9EED16FA20 FOREIGN KEY (metier_id) REFERENCES metier (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE metier_atelier ADD CONSTRAINT FK_ECDFFF9E82E2CF35 FOREIGN KEY (atelier_id) REFERENCES atelier (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE metier_competence DROP FOREIGN KEY FK_2B2C55BED16FA20');
        $this->addSql('ALTER TABLE metier_competence DROP FOREIGN KEY FK_2B2C55B15761DAB');
        $this->addSql('ALTER TABLE metier_activite DROP FOREIGN KEY FK_DA8FEC3ED16FA20');
        $this->addSql('ALTER TABLE metier_activite DROP FOREIGN KEY FK_DA8FEC39B0F88B1');
        $this->addSql('ALTER TABLE metier_atelier DROP FOREIGN KEY FK_ECDFFF9EED16FA20');
        $this->addSql('ALTER TABLE metier_atelier DROP FOREIGN KEY FK_ECDFFF9E82E2CF35');
        $this->addSql('DROP TABLE metier_competence');
        $this->addSql('DROP TABLE metier_activite');
        $this->addSql('DROP TABLE metier_atelier');
    }
}
