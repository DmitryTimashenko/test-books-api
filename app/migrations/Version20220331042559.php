<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220331042559 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER SEQUENCE author_id_seq RESTART WITH 30000;');
        $this->addSql('ALTER SEQUENCE author_translation_id_seq RESTART WITH 50000;');
        $this->addSql('ALTER SEQUENCE book_id_seq RESTART WITH 50000;');
        $this->addSql('ALTER SEQUENCE book_translation_id_seq RESTART WITH 50000;');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
