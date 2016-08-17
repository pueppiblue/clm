<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160817182447 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE clm_character CHANGE clm_class clm_class VARCHAR(190) DEFAULT NULL');
        $this->addSql('ALTER TABLE clm_character RENAME INDEX idx_3156ddeca76ed395 TO IDX_373973FBA76ED395');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE clm_character CHANGE clm_class clm_class VARCHAR(190) NOT NULL COLLATE utf8mb4_unicode_ci');
        $this->addSql('ALTER TABLE clm_character RENAME INDEX idx_373973fba76ed395 TO IDX_3156DDECA76ED395');
    }
}
