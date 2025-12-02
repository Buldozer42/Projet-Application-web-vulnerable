<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231218145510 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE activite (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE atelier (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE atelier_metier (atelier_id INT NOT NULL, metier_id INT NOT NULL, INDEX IDX_B09756A082E2CF35 (atelier_id), INDEX IDX_B09756A0ED16FA20 (metier_id), PRIMARY KEY(atelier_id, metier_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE competence (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE inscription (id INT AUTO_INCREMENT NOT NULL, lycee_id INT DEFAULT NULL, section_id INT DEFAULT NULL, email VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, date DATE NOT NULL, INDEX IDX_5E90F6D6D1DC61BF (lycee_id), INDEX IDX_5E90F6D6D823E37A (section_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lycee (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE metier (id INT AUTO_INCREMENT NOT NULL, competence_id INT DEFAULT NULL, activite_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, INDEX IDX_51A00D8C15761DAB (competence_id), INDEX IDX_51A00D8C9B0F88B1 (activite_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE question (id INT AUTO_INCREMENT NOT NULL, reponse_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_B6F7494ECF18BB82 (reponse_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE questionnaire (id INT AUTO_INCREMENT NOT NULL, question_id INT DEFAULT NULL, inscrit_id INT DEFAULT NULL, edition INT NOT NULL, type VARCHAR(255) NOT NULL, reponse LONGTEXT NOT NULL, UNIQUE INDEX UNIQ_7A64DAF1E27F6BF (question_id), UNIQUE INDEX UNIQ_7A64DAF6DCD4FEE (inscrit_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reponse (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ressource (id INT AUTO_INCREMENT NOT NULL, atelier_id INT DEFAULT NULL, type VARCHAR(255) NOT NULL, contenu LONGTEXT NOT NULL, INDEX IDX_939F454482E2CF35 (atelier_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE salle (id INT AUTO_INCREMENT NOT NULL, atelier_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, etage VARCHAR(255) NOT NULL, capacite_maximum INT NOT NULL, INDEX IDX_4E977E5C82E2CF35 (atelier_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE secteur (id INT AUTO_INCREMENT NOT NULL, atelier_id INT DEFAULT NULL, nnom VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, INDEX IDX_8045251F82E2CF35 (atelier_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE section (id INT AUTO_INCREMENT NOT NULL, nnom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE session (id INT AUTO_INCREMENT NOT NULL, atelier_id INT DEFAULT NULL, inscription_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_D044D5D482E2CF35 (atelier_id), UNIQUE INDEX UNIQ_D044D5D45DAC5993 (inscription_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sponsor (id INT AUTO_INCREMENT NOT NULL, logo VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, url_redirection VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE atelier_metier ADD CONSTRAINT FK_B09756A082E2CF35 FOREIGN KEY (atelier_id) REFERENCES atelier (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE atelier_metier ADD CONSTRAINT FK_B09756A0ED16FA20 FOREIGN KEY (metier_id) REFERENCES metier (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D6D1DC61BF FOREIGN KEY (lycee_id) REFERENCES lycee (id)');
        $this->addSql('ALTER TABLE inscription ADD CONSTRAINT FK_5E90F6D6D823E37A FOREIGN KEY (section_id) REFERENCES section (id)');
        $this->addSql('ALTER TABLE metier ADD CONSTRAINT FK_51A00D8C15761DAB FOREIGN KEY (competence_id) REFERENCES competence (id)');
        $this->addSql('ALTER TABLE metier ADD CONSTRAINT FK_51A00D8C9B0F88B1 FOREIGN KEY (activite_id) REFERENCES activite (id)');
        $this->addSql('ALTER TABLE question ADD CONSTRAINT FK_B6F7494ECF18BB82 FOREIGN KEY (reponse_id) REFERENCES reponse (id)');
        $this->addSql('ALTER TABLE questionnaire ADD CONSTRAINT FK_7A64DAF1E27F6BF FOREIGN KEY (question_id) REFERENCES question (id)');
        $this->addSql('ALTER TABLE questionnaire ADD CONSTRAINT FK_7A64DAF6DCD4FEE FOREIGN KEY (inscrit_id) REFERENCES inscription (id)');
        $this->addSql('ALTER TABLE ressource ADD CONSTRAINT FK_939F454482E2CF35 FOREIGN KEY (atelier_id) REFERENCES atelier (id)');
        $this->addSql('ALTER TABLE salle ADD CONSTRAINT FK_4E977E5C82E2CF35 FOREIGN KEY (atelier_id) REFERENCES atelier (id)');
        $this->addSql('ALTER TABLE secteur ADD CONSTRAINT FK_8045251F82E2CF35 FOREIGN KEY (atelier_id) REFERENCES atelier (id)');
        $this->addSql('ALTER TABLE session ADD CONSTRAINT FK_D044D5D482E2CF35 FOREIGN KEY (atelier_id) REFERENCES atelier (id)');
        $this->addSql('ALTER TABLE session ADD CONSTRAINT FK_D044D5D45DAC5993 FOREIGN KEY (inscription_id) REFERENCES inscription (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE atelier_metier DROP FOREIGN KEY FK_B09756A082E2CF35');
        $this->addSql('ALTER TABLE atelier_metier DROP FOREIGN KEY FK_B09756A0ED16FA20');
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D6D1DC61BF');
        $this->addSql('ALTER TABLE inscription DROP FOREIGN KEY FK_5E90F6D6D823E37A');
        $this->addSql('ALTER TABLE metier DROP FOREIGN KEY FK_51A00D8C15761DAB');
        $this->addSql('ALTER TABLE metier DROP FOREIGN KEY FK_51A00D8C9B0F88B1');
        $this->addSql('ALTER TABLE question DROP FOREIGN KEY FK_B6F7494ECF18BB82');
        $this->addSql('ALTER TABLE questionnaire DROP FOREIGN KEY FK_7A64DAF1E27F6BF');
        $this->addSql('ALTER TABLE questionnaire DROP FOREIGN KEY FK_7A64DAF6DCD4FEE');
        $this->addSql('ALTER TABLE ressource DROP FOREIGN KEY FK_939F454482E2CF35');
        $this->addSql('ALTER TABLE salle DROP FOREIGN KEY FK_4E977E5C82E2CF35');
        $this->addSql('ALTER TABLE secteur DROP FOREIGN KEY FK_8045251F82E2CF35');
        $this->addSql('ALTER TABLE session DROP FOREIGN KEY FK_D044D5D482E2CF35');
        $this->addSql('ALTER TABLE session DROP FOREIGN KEY FK_D044D5D45DAC5993');
        $this->addSql('DROP TABLE activite');
        $this->addSql('DROP TABLE atelier');
        $this->addSql('DROP TABLE atelier_metier');
        $this->addSql('DROP TABLE competence');
        $this->addSql('DROP TABLE inscription');
        $this->addSql('DROP TABLE lycee');
        $this->addSql('DROP TABLE metier');
        $this->addSql('DROP TABLE question');
        $this->addSql('DROP TABLE questionnaire');
        $this->addSql('DROP TABLE reponse');
        $this->addSql('DROP TABLE ressource');
        $this->addSql('DROP TABLE salle');
        $this->addSql('DROP TABLE secteur');
        $this->addSql('DROP TABLE section');
        $this->addSql('DROP TABLE session');
        $this->addSql('DROP TABLE sponsor');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
