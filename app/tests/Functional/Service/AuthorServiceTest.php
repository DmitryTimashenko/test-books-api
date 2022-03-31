<?php

namespace App\Tests\Functional\Service;

use App\Model\AuthorDTO;
use App\Model\AuthorTranslateDTO;
use App\Service\AuthorService;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AuthorServiceTest extends WebTestCase
{
    private AuthorService $service;
    private $faker;

    public function setUp(): void
    {
        /** @var AuthorService service */
        $this->service = static::getContainer()->get(AuthorService::class);
        $this->faker =  \Faker\Factory::create();
        parent::setUp();

    }

    public function test_author_should_be_created_by_using_input_dto()
    {
        $name = $this->faker->name();
        $translations = [
            new AuthorTranslateDTO('en', $name),
        ];
        $input = new AuthorDTO($translations);
        $authorEntity = $this->service->create($input);

        $this->assertEquals($name, $authorEntity->translate('en')->getName());
        $this->assertNotNull($authorEntity->getId());
    }
}