<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220327180227 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE author_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE author_translation_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE author (id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE author_translation (id INT NOT NULL, translatable_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, locale VARCHAR(5) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E89826172C2AC5D3 ON author_translation (translatable_id)');
        $this->addSql('CREATE UNIQUE INDEX author_translation_unique_translation ON author_translation (translatable_id, locale)');
        $this->addSql('ALTER TABLE author_translation ADD CONSTRAINT FK_E89826172C2AC5D3 FOREIGN KEY (translatable_id) REFERENCES author (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE author_translation DROP CONSTRAINT FK_E89826172C2AC5D3');
        $this->addSql('DROP SEQUENCE author_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE author_translation_id_seq CASCADE');
        $this->addSql('DROP TABLE author');
        $this->addSql('DROP TABLE author_translation');
    }
}
