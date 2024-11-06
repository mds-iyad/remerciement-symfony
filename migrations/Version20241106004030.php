<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241106004030 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__merci AS SELECT id, recipient_id, reason, date FROM merci');
        $this->addSql('DROP TABLE merci');
        $this->addSql('CREATE TABLE merci (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, recipient_id INTEGER DEFAULT NULL, author_id INTEGER DEFAULT NULL, reason VARCHAR(255) NOT NULL, date DATE NOT NULL, CONSTRAINT FK_86B31E76E92F8F78 FOREIGN KEY (recipient_id) REFERENCES salarie (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_86B31E76F675F31B FOREIGN KEY (author_id) REFERENCES salarie (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO merci (id, recipient_id, reason, date) SELECT id, recipient_id, reason, date FROM __temp__merci');
        $this->addSql('DROP TABLE __temp__merci');
        $this->addSql('CREATE INDEX IDX_86B31E76E92F8F78 ON merci (recipient_id)');
        $this->addSql('CREATE INDEX IDX_86B31E76F675F31B ON merci (author_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TEMPORARY TABLE __temp__merci AS SELECT id, recipient_id, reason, date FROM merci');
        $this->addSql('DROP TABLE merci');
        $this->addSql('CREATE TABLE merci (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, recipient_id INTEGER DEFAULT NULL, reason VARCHAR(255) NOT NULL, date DATE NOT NULL, author VARCHAR(255) NOT NULL, CONSTRAINT FK_86B31E76E92F8F78 FOREIGN KEY (recipient_id) REFERENCES salarie (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO merci (id, recipient_id, reason, date) SELECT id, recipient_id, reason, date FROM __temp__merci');
        $this->addSql('DROP TABLE __temp__merci');
        $this->addSql('CREATE INDEX IDX_86B31E76E92F8F78 ON merci (recipient_id)');
    }
}
