<?php

namespace App\Tests\Resource\Fixture;

use App\Entity\Author;
use App\Entity\Book;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class InitFixture extends Fixture
{

    public function load(ObjectManager $manager)
    {
        $ruFaker =  \Faker\Factory::create('ru_RU');
        $enFaker =  \Faker\Factory::create('en_GB');

        for($j = 0; $j < 2000; $j++) {
            $authorList = [];
            for($i = 0; $i < 5; $i++) {
                $author = new Author();
                $authorList[] = $author;

                $author->translate('ru')->setName("{$ruFaker->firstName()} {$ruFaker->lastName()}");
                $author->translate('en')->setName("{$enFaker->firstName()} {$enFaker->lastName()}");

                $manager->persist($author);
                $author->mergeNewTranslations();
            }

            for($i = 0; $i < 5; $i++) {
                $book = new Book();
                $book->addAuthor($authorList[array_rand($authorList)]);
                $book->translate('ru')->setTitle($ruFaker->randomLetter());
                $book->translate('en')->setTitle($ruFaker->randomLetter());
                $manager->persist($book);
                $book->mergeNewTranslations();
            }
            $manager->flush();
            unset($authorList);
        }
    }

}