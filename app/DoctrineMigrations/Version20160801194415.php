<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160801194415 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE clm_characters (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, character_name VARCHAR(190) NOT NULL, clm_class VARCHAR(190) NOT NULL, preferred_set VARCHAR(190) DEFAULT NULL, INDEX IDX_3156DDECA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fos_user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL, username_canonical VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, email_canonical VARCHAR(255) NOT NULL, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, locked TINYINT(1) NOT NULL, expired TINYINT(1) NOT NULL, expires_at DATETIME DEFAULT NULL, confirmation_token VARCHAR(255) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', credentials_expired TINYINT(1) NOT NULL, credentials_expire_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_957A647992FC23A8 (username_canonical), UNIQUE INDEX UNIQ_957A6479A0D96FBF (email_canonical), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE clm_account (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(190) NOT NULL, tear INT DEFAULT NULL, acc INT DEFAULT NULL, weapon INT DEFAULT NULL, item INT DEFAULT NULL, urn INT DEFAULT NULL, UNIQUE INDEX UNIQ_A81AAB685E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE clm_item (id INT AUTO_INCREMENT NOT NULL, looter_id INT DEFAULT NULL, name VARCHAR(190) NOT NULL, drop_date DATETIME NOT NULL, category VARCHAR(190) DEFAULT NULL, is_cash TINYINT(1) DEFAULT NULL, INDEX IDX_4726E03CB13C2BDA (looter_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE clm_characters ADD CONSTRAINT FK_3156DDECA76ED395 FOREIGN KEY (user_id) REFERENCES clm_account (id)');
        $this->addSql('ALTER TABLE clm_item ADD CONSTRAINT FK_4726E03CB13C2BDA FOREIGN KEY (looter_id) REFERENCES clm_account (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE clm_characters DROP FOREIGN KEY FK_3156DDECA76ED395');
        $this->addSql('ALTER TABLE clm_item DROP FOREIGN KEY FK_4726E03CB13C2BDA');
        $this->addSql('DROP TABLE clm_characters');
        $this->addSql('DROP TABLE fos_user');
        $this->addSql('DROP TABLE clm_account');
        $this->addSql('DROP TABLE clm_item');
    }
}
