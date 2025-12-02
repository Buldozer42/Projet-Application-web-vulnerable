<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240115070648 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE questionnaire_inscription DROP FOREIGN KEY FK_D7B42CF65DAC5993');
        $this->addSql('ALTER TABLE questionnaire_inscription DROP FOREIGN KEY FK_D7B42CF6CE07E8FF');
        $this->addSql('ALTER TABLE questionnaire_question DROP FOREIGN KEY FK_28CC40C3CE07E8FF');
        $this->addSql('ALTER TABLE questionnaire_question DROP FOREIGN KEY FK_28CC40C31E27F6BF');
        $this->addSql('DROP TABLE questionnaire_inscription');
        $this->addSql('DROP TABLE questionnaire_question');
        $this->addSql('ALTER TABLE atelier CHANGE date_debut date_debut DATETIME DEFAULT NULL, CHANGE date_fin date_fin DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE questionnaire ADD question_id INT DEFAULT NULL, ADD inscrit_id INT DEFAULT NULL, ADD edition INT NOT NULL, ADD type VARCHAR(255) NOT NULL, ADD reponse LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE questionnaire ADD CONSTRAINT FK_7A64DAF1E27F6BF FOREIGN KEY (question_id) REFERENCES question (id)');
        $this->addSql('ALTER TABLE questionnaire ADD CONSTRAINT FK_7A64DAF6DCD4FEE FOREIGN KEY (inscrit_id) REFERENCES inscription (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7A64DAF1E27F6BF ON questionnaire (question_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7A64DAF6DCD4FEE ON questionnaire (inscrit_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE questionnaire_inscription (questionnaire_id INT NOT NULL, inscription_id INT NOT NULL, INDEX IDX_D7B42CF65DAC5993 (inscription_id), INDEX IDX_D7B42CF6CE07E8FF (questionnaire_id), PRIMARY KEY(questionnaire_id, inscription_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE questionnaire_question (questionnaire_id INT NOT NULL, question_id INT NOT NULL, INDEX IDX_28CC40C31E27F6BF (question_id), INDEX IDX_28CC40C3CE07E8FF (questionnaire_id), PRIMARY KEY(questionnaire_id, question_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE questionnaire_inscription ADD CONSTRAINT FK_D7B42CF65DAC5993 FOREIGN KEY (inscription_id) REFERENCES inscription (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE questionnaire_inscription ADD CONSTRAINT FK_D7B42CF6CE07E8FF FOREIGN KEY (questionnaire_id) REFERENCES questionnaire (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE questionnaire_question ADD CONSTRAINT FK_28CC40C3CE07E8FF FOREIGN KEY (questionnaire_id) REFERENCES questionnaire (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE questionnaire_question ADD CONSTRAINT FK_28CC40C31E27F6BF FOREIGN KEY (question_id) REFERENCES question (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE atelier CHANGE date_debut date_debut DATE DEFAULT NULL, CHANGE date_fin date_fin DATE DEFAULT NULL');
        $this->addSql('ALTER TABLE questionnaire DROP FOREIGN KEY FK_7A64DAF1E27F6BF');
        $this->addSql('ALTER TABLE questionnaire DROP FOREIGN KEY FK_7A64DAF6DCD4FEE');
        $this->addSql('DROP INDEX UNIQ_7A64DAF1E27F6BF ON questionnaire');
        $this->addSql('DROP INDEX UNIQ_7A64DAF6DCD4FEE ON questionnaire');
        $this->addSql('ALTER TABLE questionnaire DROP question_id, DROP inscrit_id, DROP edition, DROP type, DROP reponse');
    }
}
