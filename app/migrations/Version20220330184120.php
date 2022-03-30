<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220330184120 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $faker =  \Faker\Factory::create('ru_RU');
        for($i = 1; $i < 10001; $i++) {
            $name = "{$faker->firstName()} {$faker->lastName()}";
            $this->addSql("INSERT INTO public.author_translation (id, translatable_id, name, locale)
VALUES ($i::integer, $i::integer, '$name'::varchar(255), 'ru'::varchar(5))");
        }
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
