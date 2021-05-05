<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210505122222 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE simulation (id INT AUTO_INCREMENT NOT NULL, annee_id INT DEFAULT NULL, contribuable_id INT NOT NULL, created_at DATETIME NOT NULL, revenu_net_ct DOUBLE PRECISION NOT NULL, revenu_net_cj DOUBLE PRECISION DEFAULT NULL, INDEX IDX_CBDA467B543EC5F0 (annee_id), INDEX IDX_CBDA467B31DEE1C6 (contribuable_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE simulation ADD CONSTRAINT FK_CBDA467B543EC5F0 FOREIGN KEY (annee_id) REFERENCES bareme (id)');
        $this->addSql('ALTER TABLE simulation ADD CONSTRAINT FK_CBDA467B31DEE1C6 FOREIGN KEY (contribuable_id) REFERENCES contribuable (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE simulation');
    }
}
