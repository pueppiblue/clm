<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160818150113 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE clm_character DROP FOREIGN KEY FK_3156DDECA76ED395');
        $this->addSql('ALTER TABLE clm_character CHANGE clm_class clm_class VARCHAR(190) DEFAULT NULL');
        $this->addSql('DROP INDEX idx_3156ddeca76ed395 ON clm_character');
        $this->addSql('CREATE INDEX IDX_373973FBA76ED395 ON clm_character (user_id)');
        $this->addSql('ALTER TABLE clm_character ADD CONSTRAINT FK_3156DDECA76ED395 FOREIGN KEY (user_id) REFERENCES clm_account (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE clm_character DROP FOREIGN KEY FK_373973FBA76ED395');
        $this->addSql('ALTER TABLE clm_character CHANGE clm_class clm_class VARCHAR(190) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('DROP INDEX idx_373973fba76ed395 ON clm_character');
        $this->addSql('CREATE INDEX IDX_3156DDECA76ED395 ON clm_character (user_id)');
        $this->addSql('ALTER TABLE clm_character ADD CONSTRAINT FK_373973FBA76ED395 FOREIGN KEY (user_id) REFERENCES clm_account (id)');
    }
}
