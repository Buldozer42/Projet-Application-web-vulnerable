<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231228130533 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE atelier_ressource (atelier_id INT NOT NULL, ressource_id INT NOT NULL, INDEX IDX_433ADBB182E2CF35 (atelier_id), INDEX IDX_433ADBB1FC6CD52A (ressource_id), PRIMARY KEY(atelier_id, ressource_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE atelier_salle (atelier_id INT NOT NULL, salle_id INT NOT NULL, INDEX IDX_77544A1782E2CF35 (atelier_id), INDEX IDX_77544A17DC304035 (salle_id), PRIMARY KEY(atelier_id, salle_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE atelier_ressource ADD CONSTRAINT FK_433ADBB182E2CF35 FOREIGN KEY (atelier_id) REFERENCES atelier (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE atelier_ressource ADD CONSTRAINT FK_433ADBB1FC6CD52A FOREIGN KEY (ressource_id) REFERENCES ressource (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE atelier_salle ADD CONSTRAINT FK_77544A1782E2CF35 FOREIGN KEY (atelier_id) REFERENCES atelier (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE atelier_salle ADD CONSTRAINT FK_77544A17DC304035 FOREIGN KEY (salle_id) REFERENCES salle (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE atelier DROP FOREIGN KEY FK_E1BB1823DC304035');
        $this->addSql('ALTER TABLE atelier DROP FOREIGN KEY FK_E1BB1823FC6CD52A');
        $this->addSql('DROP INDEX IDX_E1BB1823DC304035 ON atelier');
        $this->addSql('DROP INDEX IDX_E1BB1823FC6CD52A ON atelier');
        $this->addSql('ALTER TABLE atelier DROP salle_id, DROP ressource_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE atelier_ressource DROP FOREIGN KEY FK_433ADBB182E2CF35');
        $this->addSql('ALTER TABLE atelier_ressource DROP FOREIGN KEY FK_433ADBB1FC6CD52A');
        $this->addSql('ALTER TABLE atelier_salle DROP FOREIGN KEY FK_77544A1782E2CF35');
        $this->addSql('ALTER TABLE atelier_salle DROP FOREIGN KEY FK_77544A17DC304035');
        $this->addSql('DROP TABLE atelier_ressource');
        $this->addSql('DROP TABLE atelier_salle');
        $this->addSql('ALTER TABLE atelier ADD salle_id INT DEFAULT NULL, ADD ressource_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE atelier ADD CONSTRAINT FK_E1BB1823DC304035 FOREIGN KEY (salle_id) REFERENCES salle (id)');
        $this->addSql('ALTER TABLE atelier ADD CONSTRAINT FK_E1BB1823FC6CD52A FOREIGN KEY (ressource_id) REFERENCES ressource (id)');
        $this->addSql('CREATE INDEX IDX_E1BB1823DC304035 ON atelier (salle_id)');
        $this->addSql('CREATE INDEX IDX_E1BB1823FC6CD52A ON atelier (ressource_id)');
    }
}
