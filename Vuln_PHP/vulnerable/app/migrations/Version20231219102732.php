<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231219102732 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE sponsor');
        $this->addSql('ALTER TABLE atelier ADD metier_id INT DEFAULT NULL, ADD ressource_id INT DEFAULT NULL, ADD secteur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE atelier ADD CONSTRAINT FK_E1BB1823ED16FA20 FOREIGN KEY (metier_id) REFERENCES metier (id)');
        $this->addSql('ALTER TABLE atelier ADD CONSTRAINT FK_E1BB1823FC6CD52A FOREIGN KEY (ressource_id) REFERENCES ressource (id)');
        $this->addSql('ALTER TABLE atelier ADD CONSTRAINT FK_E1BB18239F7E4405 FOREIGN KEY (secteur_id) REFERENCES secteur (id)');
        $this->addSql('CREATE INDEX IDX_E1BB1823ED16FA20 ON atelier (metier_id)');
        $this->addSql('CREATE INDEX IDX_E1BB1823FC6CD52A ON atelier (ressource_id)');
        $this->addSql('CREATE INDEX IDX_E1BB18239F7E4405 ON atelier (secteur_id)');
        $this->addSql('ALTER TABLE ressource DROP FOREIGN KEY FK_939F454482E2CF35');
        $this->addSql('DROP INDEX IDX_939F454482E2CF35 ON ressource');
        $this->addSql('ALTER TABLE ressource DROP atelier_id');
        $this->addSql('ALTER TABLE secteur DROP FOREIGN KEY FK_8045251F82E2CF35');
        $this->addSql('DROP INDEX IDX_8045251F82E2CF35 ON secteur');
        $this->addSql('ALTER TABLE secteur DROP atelier_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE sponsor (id INT AUTO_INCREMENT NOT NULL, logo VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, nom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, url_redirection VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE atelier DROP FOREIGN KEY FK_E1BB1823ED16FA20');
        $this->addSql('ALTER TABLE atelier DROP FOREIGN KEY FK_E1BB1823FC6CD52A');
        $this->addSql('ALTER TABLE atelier DROP FOREIGN KEY FK_E1BB18239F7E4405');
        $this->addSql('DROP INDEX IDX_E1BB1823ED16FA20 ON atelier');
        $this->addSql('DROP INDEX IDX_E1BB1823FC6CD52A ON atelier');
        $this->addSql('DROP INDEX IDX_E1BB18239F7E4405 ON atelier');
        $this->addSql('ALTER TABLE atelier DROP metier_id, DROP ressource_id, DROP secteur_id');
        $this->addSql('ALTER TABLE ressource ADD atelier_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ressource ADD CONSTRAINT FK_939F454482E2CF35 FOREIGN KEY (atelier_id) REFERENCES atelier (id)');
        $this->addSql('CREATE INDEX IDX_939F454482E2CF35 ON ressource (atelier_id)');
        $this->addSql('ALTER TABLE secteur ADD atelier_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE secteur ADD CONSTRAINT FK_8045251F82E2CF35 FOREIGN KEY (atelier_id) REFERENCES atelier (id)');
        $this->addSql('CREATE INDEX IDX_8045251F82E2CF35 ON secteur (atelier_id)');
    }
}
