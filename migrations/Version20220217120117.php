<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220217120117 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE candidat (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, dat_naissance DATE NOT NULL, UNIQUE INDEX UNIQ_6AB5B471A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE evaluation (id INT AUTO_INCREMENT NOT NULL, candidat_id_id INT NOT NULL, formation_id_id INT NOT NULL, formateur_id_id INT NOT NULL, note DOUBLE PRECISION NOT NULL, INDEX IDX_1323A575BFA9F225 (candidat_id_id), INDEX IDX_1323A5759CF0022 (formation_id_id), INDEX IDX_1323A575A2FE286F (formateur_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE form_ses_seance (id INT AUTO_INCREMENT NOT NULL, formation_id_id INT NOT NULL, session_id_id INT NOT NULL, seance_id_id INT NOT NULL, INDEX IDX_783A8D129CF0022 (formation_id_id), INDEX IDX_783A8D12A4392681 (session_id_id), INDEX IDX_783A8D1260528D1B (seance_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formateur (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, datenaissance DATE NOT NULL, email VARCHAR(255) NOT NULL, domaine VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_ED767E4FA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE formation (id INT AUTO_INCREMENT NOT NULL, description VARCHAR(255) NOT NULL, prix INT NOT NULL, duree VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE inscrit (id INT AUTO_INCREMENT NOT NULL, candidat_id_id INT NOT NULL, formation_id_id INT NOT NULL, INDEX IDX_927FA365BFA9F225 (candidat_id_id), INDEX IDX_927FA3659CF0022 (formation_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE presence (id INT AUTO_INCREMENT NOT NULL, formation_id_id INT NOT NULL, session_id_id INT NOT NULL, seance_id_id INT NOT NULL, candidat_id_id INT NOT NULL, INDEX IDX_6977C7A59CF0022 (formation_id_id), INDEX IDX_6977C7A5A4392681 (session_id_id), INDEX IDX_6977C7A560528D1B (seance_id_id), INDEX IDX_6977C7A5BFA9F225 (candidat_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE seance (id INT AUTO_INCREMENT NOT NULL, dat_heure DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE session (id INT AUTO_INCREMENT NOT NULL, date_debut DATE NOT NULL, date_fin DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE candidat ADD CONSTRAINT FK_6AB5B471A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE evaluation ADD CONSTRAINT FK_1323A575BFA9F225 FOREIGN KEY (candidat_id_id) REFERENCES candidat (id)');
        $this->addSql('ALTER TABLE evaluation ADD CONSTRAINT FK_1323A5759CF0022 FOREIGN KEY (formation_id_id) REFERENCES formation (id)');
        $this->addSql('ALTER TABLE evaluation ADD CONSTRAINT FK_1323A575A2FE286F FOREIGN KEY (formateur_id_id) REFERENCES formateur (id)');
        $this->addSql('ALTER TABLE form_ses_seance ADD CONSTRAINT FK_783A8D129CF0022 FOREIGN KEY (formation_id_id) REFERENCES formation (id)');
        $this->addSql('ALTER TABLE form_ses_seance ADD CONSTRAINT FK_783A8D12A4392681 FOREIGN KEY (session_id_id) REFERENCES session (id)');
        $this->addSql('ALTER TABLE form_ses_seance ADD CONSTRAINT FK_783A8D1260528D1B FOREIGN KEY (seance_id_id) REFERENCES seance (id)');
        $this->addSql('ALTER TABLE formateur ADD CONSTRAINT FK_ED767E4FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE inscrit ADD CONSTRAINT FK_927FA365BFA9F225 FOREIGN KEY (candidat_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE inscrit ADD CONSTRAINT FK_927FA3659CF0022 FOREIGN KEY (formation_id_id) REFERENCES formation (id)');
        $this->addSql('ALTER TABLE presence ADD CONSTRAINT FK_6977C7A59CF0022 FOREIGN KEY (formation_id_id) REFERENCES formation (id)');
        $this->addSql('ALTER TABLE presence ADD CONSTRAINT FK_6977C7A5A4392681 FOREIGN KEY (session_id_id) REFERENCES session (id)');
        $this->addSql('ALTER TABLE presence ADD CONSTRAINT FK_6977C7A560528D1B FOREIGN KEY (seance_id_id) REFERENCES seance (id)');
        $this->addSql('ALTER TABLE presence ADD CONSTRAINT FK_6977C7A5BFA9F225 FOREIGN KEY (candidat_id_id) REFERENCES candidat (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE evaluation DROP FOREIGN KEY FK_1323A575BFA9F225');
        $this->addSql('ALTER TABLE presence DROP FOREIGN KEY FK_6977C7A5BFA9F225');
        $this->addSql('ALTER TABLE evaluation DROP FOREIGN KEY FK_1323A575A2FE286F');
        $this->addSql('ALTER TABLE evaluation DROP FOREIGN KEY FK_1323A5759CF0022');
        $this->addSql('ALTER TABLE form_ses_seance DROP FOREIGN KEY FK_783A8D129CF0022');
        $this->addSql('ALTER TABLE inscrit DROP FOREIGN KEY FK_927FA3659CF0022');
        $this->addSql('ALTER TABLE presence DROP FOREIGN KEY FK_6977C7A59CF0022');
        $this->addSql('ALTER TABLE form_ses_seance DROP FOREIGN KEY FK_783A8D1260528D1B');
        $this->addSql('ALTER TABLE presence DROP FOREIGN KEY FK_6977C7A560528D1B');
        $this->addSql('ALTER TABLE form_ses_seance DROP FOREIGN KEY FK_783A8D12A4392681');
        $this->addSql('ALTER TABLE presence DROP FOREIGN KEY FK_6977C7A5A4392681');
        $this->addSql('ALTER TABLE candidat DROP FOREIGN KEY FK_6AB5B471A76ED395');
        $this->addSql('ALTER TABLE formateur DROP FOREIGN KEY FK_ED767E4FA76ED395');
        $this->addSql('ALTER TABLE inscrit DROP FOREIGN KEY FK_927FA365BFA9F225');
        $this->addSql('DROP TABLE candidat');
        $this->addSql('DROP TABLE evaluation');
        $this->addSql('DROP TABLE form_ses_seance');
        $this->addSql('DROP TABLE formateur');
        $this->addSql('DROP TABLE formation');
        $this->addSql('DROP TABLE inscrit');
        $this->addSql('DROP TABLE presence');
        $this->addSql('DROP TABLE seance');
        $this->addSql('DROP TABLE session');
        $this->addSql('DROP TABLE user');
    }
}
