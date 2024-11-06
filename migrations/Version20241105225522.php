<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241105225522 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE merci (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, author VARCHAR(255) NOT NULL, recipient VARCHAR(255) NOT NULL, reason VARCHAR(255) NOT NULL, date DATE NOT NULL)');
        $this->addSql('CREATE TABLE Salarie (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, avatar VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE merci');
        $this->addSql('DROP TABLE Salarie');
    }
}
