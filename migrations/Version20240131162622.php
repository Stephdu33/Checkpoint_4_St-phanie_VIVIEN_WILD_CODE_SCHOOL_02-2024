<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240131162622 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE skill_work (skill_id INT NOT NULL, work_id INT NOT NULL, INDEX IDX_140FF4325585C142 (skill_id), INDEX IDX_140FF432BB3453DB (work_id), PRIMARY KEY(skill_id, work_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE skill_experience (skill_id INT NOT NULL, experience_id INT NOT NULL, INDEX IDX_10191D715585C142 (skill_id), INDEX IDX_10191D7146E90E27 (experience_id), PRIMARY KEY(skill_id, experience_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE skill_work ADD CONSTRAINT FK_140FF4325585C142 FOREIGN KEY (skill_id) REFERENCES skill (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE skill_work ADD CONSTRAINT FK_140FF432BB3453DB FOREIGN KEY (work_id) REFERENCES work (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE skill_experience ADD CONSTRAINT FK_10191D715585C142 FOREIGN KEY (skill_id) REFERENCES skill (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE skill_experience ADD CONSTRAINT FK_10191D7146E90E27 FOREIGN KEY (experience_id) REFERENCES experience (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE image ADD work_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045FBB3453DB FOREIGN KEY (work_id) REFERENCES work (id)');
        $this->addSql('CREATE INDEX IDX_C53D045FBB3453DB ON image (work_id)');
        $this->addSql('ALTER TABLE skill ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE skill ADD CONSTRAINT FK_5E3DE477A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_5E3DE477A76ED395 ON skill (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE skill_work DROP FOREIGN KEY FK_140FF4325585C142');
        $this->addSql('ALTER TABLE skill_work DROP FOREIGN KEY FK_140FF432BB3453DB');
        $this->addSql('ALTER TABLE skill_experience DROP FOREIGN KEY FK_10191D715585C142');
        $this->addSql('ALTER TABLE skill_experience DROP FOREIGN KEY FK_10191D7146E90E27');
        $this->addSql('DROP TABLE skill_work');
        $this->addSql('DROP TABLE skill_experience');
        $this->addSql('ALTER TABLE skill DROP FOREIGN KEY FK_5E3DE477A76ED395');
        $this->addSql('DROP INDEX IDX_5E3DE477A76ED395 ON skill');
        $this->addSql('ALTER TABLE skill DROP user_id');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045FBB3453DB');
        $this->addSql('DROP INDEX IDX_C53D045FBB3453DB ON image');
        $this->addSql('ALTER TABLE image DROP work_id');
    }
}
