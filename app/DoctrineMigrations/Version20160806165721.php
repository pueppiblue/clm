<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160806165721 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE clm_character (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, character_name VARCHAR(190) NOT NULL, clm_class VARCHAR(190) NOT NULL, preferred_set VARCHAR(190) DEFAULT NULL, INDEX IDX_373973FBA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE clm_raid (id INT AUTO_INCREMENT NOT NULL, date DATETIME NOT NULL, content_tier VARCHAR(190) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE clm_character ADD CONSTRAINT FK_373973FBA76ED395 FOREIGN KEY (user_id) REFERENCES clm_account (id)');
        $this->addSql('DROP TABLE clm_characters');
        $this->addSql('ALTER TABLE clm_item DROP FOREIGN KEY FK_4726E03CB13C2BDA');
        $this->addSql('DROP INDEX IDX_4726E03CB13C2BDA ON clm_item');
        $this->addSql('ALTER TABLE clm_item DROP looter_id');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE clm_characters (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, character_name VARCHAR(190) NOT NULL COLLATE utf8mb4_unicode_ci, clm_class VARCHAR(190) NOT NULL COLLATE utf8mb4_unicode_ci, preferred_set VARCHAR(190) DEFAULT NULL COLLATE utf8mb4_unicode_ci, INDEX IDX_3156DDECA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE clm_characters ADD CONSTRAINT FK_3156DDECA76ED395 FOREIGN KEY (user_id) REFERENCES clm_account (id)');
        $this->addSql('DROP TABLE clm_character');
        $this->addSql('DROP TABLE clm_raid');
        $this->addSql('ALTER TABLE clm_item ADD looter_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE clm_item ADD CONSTRAINT FK_4726E03CB13C2BDA FOREIGN KEY (looter_id) REFERENCES clm_account (id)');
        $this->addSql('CREATE INDEX IDX_4726E03CB13C2BDA ON clm_item (looter_id)');
    }
}
