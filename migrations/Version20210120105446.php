<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210120105446 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE recepten (id INT AUTO_INCREMENT NOT NULL, medicijnen_id INT NOT NULL, datum DATE NOT NULL, periode VARCHAR(255) NOT NULL, INDEX IDX_72C1CA29FFC32E5 (medicijnen_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE recepten ADD CONSTRAINT FK_72C1CA29FFC32E5 FOREIGN KEY (medicijnen_id) REFERENCES medicijnen (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE recepten');
    }
}
