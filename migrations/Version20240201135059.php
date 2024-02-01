<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240201135059 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, firstname VARCHAR(500) NOT NULL, lastname VARCHAR(500) NOT NULL, email VARCHAR(255) NOT NULL, phonenumber INT NOT NULL, message VARCHAR(1000) NOT NULL, company VARCHAR(255) NOT NULL, job VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE education (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, description VARCHAR(500) NOT NULL, year DATE NOT NULL, school VARCHAR(500) NOT NULL, INDEX IDX_DB0A5ED2A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE experience (id INT AUTO_INCREMENT NOT NULL, company VARCHAR(255) NOT NULL, job VARCHAR(500) NOT NULL, startyear DATE NOT NULL, endyear DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, work_id INT DEFAULT NULL, photo VARCHAR(500) NOT NULL, INDEX IDX_C53D045FBB3453DB (work_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE language (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, level VARCHAR(255) NOT NULL, INDEX IDX_D4DB71B5A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE meeting (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, contact_id INT DEFAULT NULL, date DATE NOT NULL, hour TIME NOT NULL, INDEX IDX_F515E139A76ED395 (user_id), UNIQUE INDEX UNIQ_F515E139E7A1254A (contact_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE skill (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, category VARCHAR(255) NOT NULL, INDEX IDX_5E3DE477A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE skill_experience (skill_id INT NOT NULL, experience_id INT NOT NULL, INDEX IDX_10191D715585C142 (skill_id), INDEX IDX_10191D7146E90E27 (experience_id), PRIMARY KEY(skill_id, experience_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE skill_work (skill_id INT NOT NULL, work_id INT NOT NULL, INDEX IDX_140FF4325585C142 (skill_id), INDEX IDX_140FF432BB3453DB (work_id), PRIMARY KEY(skill_id, work_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE work (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(500) NOT NULL, description VARCHAR(1000) NOT NULL, github VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE education ADD CONSTRAINT FK_DB0A5ED2A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045FBB3453DB FOREIGN KEY (work_id) REFERENCES work (id)');
        $this->addSql('ALTER TABLE language ADD CONSTRAINT FK_D4DB71B5A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE meeting ADD CONSTRAINT FK_F515E139A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE meeting ADD CONSTRAINT FK_F515E139E7A1254A FOREIGN KEY (contact_id) REFERENCES contact (id)');
        $this->addSql('ALTER TABLE skill ADD CONSTRAINT FK_5E3DE477A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE skill_experience ADD CONSTRAINT FK_10191D715585C142 FOREIGN KEY (skill_id) REFERENCES skill (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE skill_experience ADD CONSTRAINT FK_10191D7146E90E27 FOREIGN KEY (experience_id) REFERENCES experience (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE skill_work ADD CONSTRAINT FK_140FF4325585C142 FOREIGN KEY (skill_id) REFERENCES skill (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE skill_work ADD CONSTRAINT FK_140FF432BB3453DB FOREIGN KEY (work_id) REFERENCES work (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user ADD phonenumber INT DEFAULT NULL, ADD localisation VARCHAR(255) DEFAULT NULL, ADD description VARCHAR(1000) DEFAULT NULL, ADD job VARCHAR(500) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE education DROP FOREIGN KEY FK_DB0A5ED2A76ED395');
        $this->addSql('ALTER TABLE image DROP FOREIGN KEY FK_C53D045FBB3453DB');
        $this->addSql('ALTER TABLE language DROP FOREIGN KEY FK_D4DB71B5A76ED395');
        $this->addSql('ALTER TABLE meeting DROP FOREIGN KEY FK_F515E139A76ED395');
        $this->addSql('ALTER TABLE meeting DROP FOREIGN KEY FK_F515E139E7A1254A');
        $this->addSql('ALTER TABLE skill DROP FOREIGN KEY FK_5E3DE477A76ED395');
        $this->addSql('ALTER TABLE skill_experience DROP FOREIGN KEY FK_10191D715585C142');
        $this->addSql('ALTER TABLE skill_experience DROP FOREIGN KEY FK_10191D7146E90E27');
        $this->addSql('ALTER TABLE skill_work DROP FOREIGN KEY FK_140FF4325585C142');
        $this->addSql('ALTER TABLE skill_work DROP FOREIGN KEY FK_140FF432BB3453DB');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE education');
        $this->addSql('DROP TABLE experience');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE language');
        $this->addSql('DROP TABLE meeting');
        $this->addSql('DROP TABLE skill');
        $this->addSql('DROP TABLE skill_experience');
        $this->addSql('DROP TABLE skill_work');
        $this->addSql('DROP TABLE work');
        $this->addSql('ALTER TABLE user DROP phonenumber, DROP localisation, DROP description, DROP job');
    }
}
