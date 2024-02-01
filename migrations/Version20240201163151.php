<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240201163151 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE meeting DROP FOREIGN KEY FK_F515E139A76ED395');
        $this->addSql('ALTER TABLE meeting DROP FOREIGN KEY FK_F515E139E7A1254A');
        $this->addSql('DROP TABLE meeting');
        $this->addSql('ALTER TABLE education DROP FOREIGN KEY FK_DB0A5ED2A76ED395');
        $this->addSql('DROP INDEX IDX_DB0A5ED2A76ED395 ON education');
        $this->addSql('ALTER TABLE education DROP user_id, DROP description, CHANGE title title VARCHAR(500) NOT NULL, CHANGE year date DATE NOT NULL');
        $this->addSql('ALTER TABLE experience DROP endyear');
        $this->addSql('ALTER TABLE language DROP FOREIGN KEY FK_D4DB71B5A76ED395');
        $this->addSql('DROP INDEX IDX_D4DB71B5A76ED395 ON language');
        $this->addSql('ALTER TABLE language DROP user_id');
        $this->addSql('DROP INDEX UNIQ_8D93D649E7927C74 ON user');
        $this->addSql('ALTER TABLE user CHANGE email email VARCHAR(255) NOT NULL, CHANGE phonenumber phonenumber INT NOT NULL, CHANGE localisation localisation VARCHAR(255) NOT NULL, CHANGE description description VARCHAR(1000) NOT NULL, CHANGE job job VARCHAR(500) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE meeting (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, contact_id INT DEFAULT NULL, date DATE NOT NULL, hour TIME NOT NULL, INDEX IDX_F515E139A76ED395 (user_id), UNIQUE INDEX UNIQ_F515E139E7A1254A (contact_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE meeting ADD CONSTRAINT FK_F515E139A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE meeting ADD CONSTRAINT FK_F515E139E7A1254A FOREIGN KEY (contact_id) REFERENCES contact (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE user CHANGE email email VARCHAR(180) NOT NULL, CHANGE phonenumber phonenumber INT DEFAULT NULL, CHANGE localisation localisation VARCHAR(255) DEFAULT NULL, CHANGE description description VARCHAR(1000) DEFAULT NULL, CHANGE job job VARCHAR(500) DEFAULT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON user (email)');
        $this->addSql('ALTER TABLE experience ADD endyear DATE NOT NULL');
        $this->addSql('ALTER TABLE language ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE language ADD CONSTRAINT FK_D4DB71B5A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_D4DB71B5A76ED395 ON language (user_id)');
        $this->addSql('ALTER TABLE education ADD user_id INT DEFAULT NULL, ADD description VARCHAR(500) NOT NULL, CHANGE title title VARCHAR(255) NOT NULL, CHANGE date year DATE NOT NULL');
        $this->addSql('ALTER TABLE education ADD CONSTRAINT FK_DB0A5ED2A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_DB0A5ED2A76ED395 ON education (user_id)');
    }
}
