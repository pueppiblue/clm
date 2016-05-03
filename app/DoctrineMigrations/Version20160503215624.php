<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160503215624 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE clm_characters (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, clm_class VARCHAR(255) NOT NULL, preferred_set VARCHAR(255) DEFAULT NULL, INDEX IDX_3156DDECA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE item (id INT AUTO_INCREMENT NOT NULL, looter_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, drop_date DATETIME NOT NULL, type VARCHAR(255) DEFAULT NULL, isCash TINYINT(1) DEFAULT NULL, INDEX IDX_1F1B251EB13C2BDA (looter_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, tear INT NOT NULL, acc INT NOT NULL, weapon INT NOT NULL, item INT NOT NULL, urn INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE clm_characters ADD CONSTRAINT FK_3156DDECA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE item ADD CONSTRAINT FK_1F1B251EB13C2BDA FOREIGN KEY (looter_id) REFERENCES user (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE clm_characters DROP FOREIGN KEY FK_3156DDECA76ED395');
        $this->addSql('ALTER TABLE item DROP FOREIGN KEY FK_1F1B251EB13C2BDA');
        $this->addSql('DROP TABLE clm_characters');
        $this->addSql('DROP TABLE item');
        $this->addSql('DROP TABLE user');
    }
}
