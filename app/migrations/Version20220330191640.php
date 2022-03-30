<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220330191640 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        for($i = 1; $i < 10001; $i++) {
            $title = "русский заголовок $i";
            $this->addSql("INSERT INTO public.book_translation (id, translatable_id, title, locale)
VALUES ($i::integer, $i::integer, '$title'::varchar(255), 'ru'::varchar(5))");
        }
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
