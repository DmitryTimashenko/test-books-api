<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220330183332 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'generate authors';
    }

    public function up(Schema $schema): void
    {
        for($i = 1; $i <= 10000; $i++) {
            $this->addSql("INSERT INTO public.author (id) VALUES ($i::integer)");
        }
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
    }
}
