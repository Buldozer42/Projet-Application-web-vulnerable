<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231227225433 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE atelier DROP FOREIGN KEY FK_E1BB1823ED16FA20');
        $this->addSql('DROP INDEX IDX_E1BB1823ED16FA20 ON atelier');
        $this->addSql('ALTER TABLE atelier DROP metier_id');
        $this->addSql('ALTER TABLE metier DROP FOREIGN KEY FK_51A00D8C9B0F88B1');
        $this->addSql('ALTER TABLE metier DROP FOREIGN KEY FK_51A00D8C15761DAB');
        $this->addSql('ALTER TABLE metier DROP FOREIGN KEY FK_51A00D8C82E2CF35');
        $this->addSql('DROP INDEX IDX_51A00D8C15761DAB ON metier');
        $this->addSql('DROP INDEX IDX_51A00D8C82E2CF35 ON metier');
        $this->addSql('DROP INDEX IDX_51A00D8C9B0F88B1 ON metier');
        $this->addSql('ALTER TABLE metier DROP competence_id, DROP activite_id, DROP atelier_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE atelier ADD metier_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE atelier ADD CONSTRAINT FK_E1BB1823ED16FA20 FOREIGN KEY (metier_id) REFERENCES metier (id)');
        $this->addSql('CREATE INDEX IDX_E1BB1823ED16FA20 ON atelier (metier_id)');
        $this->addSql('ALTER TABLE metier ADD competence_id INT DEFAULT NULL, ADD activite_id INT DEFAULT NULL, ADD atelier_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE metier ADD CONSTRAINT FK_51A00D8C9B0F88B1 FOREIGN KEY (activite_id) REFERENCES activite (id)');
        $this->addSql('ALTER TABLE metier ADD CONSTRAINT FK_51A00D8C15761DAB FOREIGN KEY (competence_id) REFERENCES competence (id)');
        $this->addSql('ALTER TABLE metier ADD CONSTRAINT FK_51A00D8C82E2CF35 FOREIGN KEY (atelier_id) REFERENCES atelier (id)');
        $this->addSql('CREATE INDEX IDX_51A00D8C15761DAB ON metier (competence_id)');
        $this->addSql('CREATE INDEX IDX_51A00D8C82E2CF35 ON metier (atelier_id)');
        $this->addSql('CREATE INDEX IDX_51A00D8C9B0F88B1 ON metier (activite_id)');
    }
}
