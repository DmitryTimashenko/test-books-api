<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220330190838 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $faker =  \Faker\Factory::create('en_GB');
        for($i = 1; $i < 10001; $i++) {
            $name = "{$faker->firstName()} {$faker->lastName()}";
            $id = $i + 10000;
            $this->addSql("INSERT INTO public.author_translation (id, translatable_id, name, locale)
VALUES ($id::integer, $i::integer, '$name'::varchar(255), 'en'::varchar(5))");
        }
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
