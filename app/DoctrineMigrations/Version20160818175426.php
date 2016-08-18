<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160818175426 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE clm_character (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, character_name VARCHAR(190) NOT NULL, clm_class VARCHAR(190) DEFAULT NULL, preferred_set VARCHAR(190) DEFAULT NULL, INDEX IDX_373973FBA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fos_user (id INT AUTO_INCREMENT NOT NULL, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, locked TINYINT(1) NOT NULL, expired TINYINT(1) NOT NULL, expires_at DATETIME DEFAULT NULL, confirmation_token VARCHAR(255) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', credentials_expired TINYINT(1) NOT NULL, credentials_expire_at DATETIME DEFAULT NULL, username VARCHAR(190) NOT NULL, username_canonical VARCHAR(190) NOT NULL, email VARCHAR(190) NOT NULL, email_canonical VARCHAR(190) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE clm_raid (id INT AUTO_INCREMENT NOT NULL, date DATETIME NOT NULL, raid_tier VARCHAR(190) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE clm_account (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(190) NOT NULL, tear INT DEFAULT NULL, acc INT DEFAULT NULL, weapon INT DEFAULT NULL, item INT DEFAULT NULL, urn INT DEFAULT NULL, UNIQUE INDEX UNIQ_A81AAB685E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE clm_item (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(190) NOT NULL, drop_date DATETIME NOT NULL, category VARCHAR(190) DEFAULT NULL, is_cash TINYINT(1) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE clm_character ADD CONSTRAINT FK_373973FBA76ED395 FOREIGN KEY (user_id) REFERENCES clm_account (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE clm_character DROP FOREIGN KEY FK_373973FBA76ED395');
        $this->addSql('DROP TABLE clm_character');
        $this->addSql('DROP TABLE fos_user');
        $this->addSql('DROP TABLE clm_raid');
        $this->addSql('DROP TABLE clm_account');
        $this->addSql('DROP TABLE clm_item');
    }
}
