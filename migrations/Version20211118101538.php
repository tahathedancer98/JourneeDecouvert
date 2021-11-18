<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211118101538 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BC9D86650F');
        $this->addSql('DROP INDEX IDX_67F068BC9D86650F ON commentaire');
        $this->addSql('ALTER TABLE commentaire CHANGE user_id_id user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BCA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_67F068BCA76ED395 ON commentaire (user_id)');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F1F4ED884');
        $this->addSql('DROP INDEX IDX_C53D045F1F4ED884 ON image');
        $this->addSql('ALTER TABLE image CHANGE jd_id_id jd_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F38E4E487 FOREIGN KEY (jd_id) REFERENCES journee_decouverte (id)');
        $this->addSql('CREATE INDEX IDX_C53D045F38E4E487 ON image (jd_id)');
        $this->addSql('ALTER TABLE journee_decouverte DROP FOREIGN KEY FK_CEE3C2E7C75B6A4C');
        $this->addSql('DROP INDEX IDX_CEE3C2E7C75B6A4C ON journee_decouverte');
        $this->addSql('ALTER TABLE journee_decouverte CHANGE organisateur_id_id organisateur_id INT NOT NULL');
        $this->addSql('ALTER TABLE journee_decouverte ADD CONSTRAINT FK_CEE3C2E7D936B2FA FOREIGN KEY (organisateur_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_CEE3C2E7D936B2FA ON journee_decouverte (organisateur_id)');
        $this->addSql('ALTER TABLE participation DROP FOREIGN KEY FK_AB55E24F1F4ED884');
        $this->addSql('ALTER TABLE participation DROP FOREIGN KEY FK_AB55E24F9D86650F');
        $this->addSql('DROP INDEX IDX_AB55E24F1F4ED884 ON participation');
        $this->addSql('DROP INDEX IDX_AB55E24F9D86650F ON participation');
        $this->addSql('ALTER TABLE participation ADD user_id INT DEFAULT NULL, ADD jd_id INT DEFAULT NULL, DROP user_id_id, DROP jd_id_id');
        $this->addSql('ALTER TABLE participation ADD CONSTRAINT FK_AB55E24FA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE participation ADD CONSTRAINT FK_AB55E24F38E4E487 FOREIGN KEY (jd_id) REFERENCES journee_decouverte (id)');
        $this->addSql('CREATE INDEX IDX_AB55E24FA76ED395 ON participation (user_id)');
        $this->addSql('CREATE INDEX IDX_AB55E24F38E4E487 ON participation (jd_id)');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6499A236C31');
        $this->addSql('DROP INDEX IDX_8D93D6499A236C31 ON user');
        $this->addSql('ALTER TABLE user CHANGE niveau_id_id niveau_id INT NOT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649B3E9C81 FOREIGN KEY (niveau_id) REFERENCES niveau (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649B3E9C81 ON user (niveau_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commentaire DROP FOREIGN KEY FK_67F068BCA76ED395');
        $this->addSql('DROP INDEX IDX_67F068BCA76ED395 ON commentaire');
        $this->addSql('ALTER TABLE commentaire CHANGE user_id user_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commentaire ADD CONSTRAINT FK_67F068BC9D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_67F068BC9D86650F ON commentaire (user_id_id)');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045F38E4E487');
        $this->addSql('DROP INDEX IDX_C53D045F38E4E487 ON image');
        $this->addSql('ALTER TABLE image CHANGE jd_id jd_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F1F4ED884 FOREIGN KEY (jd_id_id) REFERENCES journee_decouverte (id)');
        $this->addSql('CREATE INDEX IDX_C53D045F1F4ED884 ON image (jd_id_id)');
        $this->addSql('ALTER TABLE journee_decouverte DROP FOREIGN KEY FK_CEE3C2E7D936B2FA');
        $this->addSql('DROP INDEX IDX_CEE3C2E7D936B2FA ON journee_decouverte');
        $this->addSql('ALTER TABLE journee_decouverte CHANGE organisateur_id organisateur_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE journee_decouverte ADD CONSTRAINT FK_CEE3C2E7C75B6A4C FOREIGN KEY (organisateur_id_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_CEE3C2E7C75B6A4C ON journee_decouverte (organisateur_id_id)');
        $this->addSql('ALTER TABLE participation DROP FOREIGN KEY FK_AB55E24FA76ED395');
        $this->addSql('ALTER TABLE participation DROP FOREIGN KEY FK_AB55E24F38E4E487');
        $this->addSql('DROP INDEX IDX_AB55E24FA76ED395 ON participation');
        $this->addSql('DROP INDEX IDX_AB55E24F38E4E487 ON participation');
        $this->addSql('ALTER TABLE participation ADD user_id_id INT DEFAULT NULL, ADD jd_id_id INT DEFAULT NULL, DROP user_id, DROP jd_id');
        $this->addSql('ALTER TABLE participation ADD CONSTRAINT FK_AB55E24F1F4ED884 FOREIGN KEY (jd_id_id) REFERENCES journee_decouverte (id)');
        $this->addSql('ALTER TABLE participation ADD CONSTRAINT FK_AB55E24F9D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_AB55E24F1F4ED884 ON participation (jd_id_id)');
        $this->addSql('CREATE INDEX IDX_AB55E24F9D86650F ON participation (user_id_id)');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D649B3E9C81');
        $this->addSql('DROP INDEX IDX_8D93D649B3E9C81 ON `user`');
        $this->addSql('ALTER TABLE `user` CHANGE niveau_id niveau_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE `user` ADD CONSTRAINT FK_8D93D6499A236C31 FOREIGN KEY (niveau_id_id) REFERENCES niveau (id)');
        $this->addSql('CREATE INDEX IDX_8D93D6499A236C31 ON `user` (niveau_id_id)');
    }
}
