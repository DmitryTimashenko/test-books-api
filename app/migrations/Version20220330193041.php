<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220330193041 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $faker =  \Faker\Factory::create();
        for($i = 1; $i < 10001; $i++) {
            $this->addSql("INSERT INTO public.book_author (book_id, author_id)
VALUES ($i::integer, {$faker->numberBetween(1,10000)}::integer)");
            $this->addSql("INSERT INTO public.book_author (book_id, author_id)
VALUES ($i::integer, {$faker->numberBetween(1,10000)}::integer)");
        }
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
