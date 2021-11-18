<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211118090758 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commentaire (id INT AUTO_INCREMENT NOT NULL, user_id_id INT DEFAULT NULL, content VARCHAR(255) DEFAULT NULL, INDEX IDX_67F068BC9D86650F (user_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, jd_id_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, INDEX IDX_C53D045F1F4ED884 (jd_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE journee_decouverte (id INT AUTO_INCREMENT NOT NULL, niveau_minimum_id INT NOT NULL, organisateur_id_id INT NOT NULL, title VARCHAR(255) DEFAULT NULL, date DATE DEFAULT NULL, lieu VARCHAR(255) DEFAULT NULL, nb_max_grimpeurs INT DEFAULT NULL, INDEX IDX_CEE3C2E76D84ADFC (niveau_minimum_id), INDEX IDX_CEE3C2E7C75B6A4C (organisateur_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE niveau (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) DEFAULT NULL, min_points INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE participation (id INT AUTO_INCREMENT NOT NULL, user_id_id INT DEFAULT NULL, jd_id_id INT DEFAULT NULL, status VARCHAR(255) DEFAULT NULL, INDEX IDX_AB55E24F9D86650F (user_id_id), INDEX IDX_AB55E24F1F4ED884 (jd_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, niveau_id_id INT NOT NULL, nom VARCHAR(255) DEFAULT NULL, prenom VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, password VARCHAR(255) DEFAULT NULL, nb_points_competence INT DEFAULT NULL, INDEX IDX_8D93D6499A236C31 (niveau_id_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC9D86650F FOREIGN KEY (user_id_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F1F4ED884 FOREIGN KEY (jd_id_id) REFERENCES journee_decouverte (id)');
        $this->addSql('ALTER TABLE journee_decouverte ADD CONSTRAINT FK_CEE3C2E76D84ADFC FOREIGN KEY (niveau_minimum_id) REFERENCES niveau (id)');
        $this->addSql('ALTER TABLE journee_decouverte ADD CONSTRAINT FK_CEE3C2E7C75B6A4C FOREIGN KEY (organisateur_id_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE participation ADD CONSTRAINT FK_AB55E24F9D86650F FOREIGN KEY (user_id_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE participation ADD CONSTRAINT FK_AB55E24F1F4ED884 FOREIGN KEY (jd_id_id) REFERENCES journee_decouverte (id)');
        $this->addSql('ALTER TABLE `user` ADD CONSTRAINT FK_8D93D6499A236C31 FOREIGN KEY (niveau_id_id) REFERENCES niveau (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F1F4ED884');
        $this->addSql('ALTER TABLE participation DROP FOREIGN KEY FK_AB55E24F1F4ED884');
        $this->addSql('ALTER TABLE journee_decouverte DROP FOREIGN KEY FK_CEE3C2E76D84ADFC');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D6499A236C31');
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BC9D86650F');
        $this->addSql('ALTER TABLE journee_decouverte DROP FOREIGN KEY FK_CEE3C2E7C75B6A4C');
        $this->addSql('ALTER TABLE participation DROP FOREIGN KEY FK_AB55E24F9D86650F');
        $this->addSql('DROP TABLE commentaire');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE journee_decouverte');
        $this->addSql('DROP TABLE niveau');
        $this->addSql('DROP TABLE participation');
        $this->addSql('DROP TABLE `user`');
    }
}
