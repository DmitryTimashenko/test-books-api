<?php

namespace App\Tests\Functional\Service;

use App\Model\BookDTO;
use App\Model\BookTranslateDTO;
use App\Service\BookService;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BookServiceTest extends WebTestCase
{
    private $faker;
    /**
     * @var BookService
     */
    private BookService $bookService;

    protected function setUp(): void
    {
        $this->faker =  \Faker\Factory::create();
        $this->bookService = static::getContainer()->get(BookService::class);
        parent::setUp();
    }

    public function test_book_should_be_created_by_using_inputdto(): void
    {
        $title = $this->faker->sentence();

        $translations = [
            new BookTranslateDTO('en', $title)
        ];

        $input = new BookDTO();
        $input->setAuthors([1 ]);
        $input->setTranslations($translations);

        $bookEntity = $this->bookService->create($input);
        $this->assertEquals($title, $bookEntity->translate('en')->getTitle());
        $this->assertNotNull($bookEntity->getId());
    }
}