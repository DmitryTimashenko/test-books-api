<?php

namespace App\Tests\Functional\Repository;

use App\Entity\Author;
use App\Repository\AuthorRepository;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AuthorRepositoryTest extends WebTestCase
{
    private AuthorRepository $repository;
    private $faker;

    public function setUp(): void
    {
        parent::setUp();

        $this->repository = static::getContainer()->get(AuthorRepository::class);
        $this->faker =  \Faker\Factory::create('ru_RU');
    }


    public function test_author_added_successfully(): void
    {
        $author = new Author();
        $russianName = "{$this->faker->firstName()} {$this->faker->lastName()}";
        $author->translate('ru')->setName($russianName);
        $this->repository->add($author);

        $expectedAuthor = $this->repository->find($author->getId());

        $this->assertEquals($russianName, $expectedAuthor->translate('ru')->getName());
    }

    public function test_can_found_by_translation_name(): void
    {
        $author = new Author();
        $russianName = "{$this->faker->firstName()} {$this->faker->lastName()}";
        $author->translate('ru')->setName($russianName);
        $this->repository->add($author);
        $expectedAuthor = $this->repository->findOneByName($russianName);
        $this->assertEquals($russianName, $expectedAuthor->translate('ru')->getName());
    }
}
