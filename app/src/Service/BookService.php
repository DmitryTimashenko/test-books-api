<?php

namespace App\Service;

use App\Entity\Book;
use App\Model\AuthorListItem;
use App\Model\BookDTO;
use App\Model\BookListItem;
use App\Model\BookListResponse;
use App\Model\BookTranslateDTO;
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

    public function create(BookDTO $data): Book
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

        return $book;
    }

    public function searchByTitle(string $title): BookListResponse
    {
        $books = $this->bookRepository->searchOneByTitle($title);
        return $this->mapBooksToBookListResponse($books);
    }

    /**
     * @param Book[] $books
     * @return BookListResponse
     */
    private function mapBooksToBookListResponse(array $books): BookListResponse
    {
        $items = [];
        foreach ($books as $book) {
            $item = new BookListItem($book->getId(), $book->translate('ru')->getTitle());
            foreach ($book->getAuthors() as $author) {
                $authorItem = new AuthorListItem($author->getId(), $author->translate('ru')->getName());
                $item->addAuthor($authorItem);
            }
            $items[] = $item;
        }
        return new BookListResponse($items);
    }
}