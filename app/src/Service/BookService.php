<?php

namespace App\Service;

use App\Entity\Book;
use App\Model\DTO\BookDTO;
use App\Model\DTO\BookTranslateDTO;
use App\Repository\AuthorRepository;
use App\Repository\BookRepository;

class BookService
{
    private BookRepository $bookRepository;
    private AuthorRepository $authorRepository;

    public function __construct(BookRepository $bookRepository, AuthorRepository $authorRepository)
    {
        $this->bookRepository = $bookRepository;
        $this->authorRepository = $authorRepository;
    }

    public function create(BookDTO $data)
    {
        $book = new Book();

        /** @var BookTranslateDTO $translation */
        foreach ($data->getTranslations() as $translation) {
            $book->translate($translation->getLanguage())->setTitle($translation->getTitle());
        }

        foreach ($data->getAuthors() as $authorId)
        {
            $author = $this->authorRepository->find($authorId);
            $book->addAuthor($author);
        }

        $this->bookRepository->add($book);
    }
}