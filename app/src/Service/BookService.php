<?php

namespace App\Service;

use App\Entity\Book;
use App\Exception\BookNotFoundException;
use App\Model\AuthorListItem;
use App\Model\BookDTO;
use App\Model\BookListItem;
use App\Model\BookListResponse;
use App\Model\BookTranslateDTO;
use App\Repository\AuthorRepository;
use App\Repository\BookRepository;

class BookService
{
    public function __construct(
        private BookRepository $bookRepository,
        private AuthorRepository $authorRepository)
    {
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
            $items[] = $this->mapBookEntityToItem($book);
        }
        return new BookListResponse($items);
    }

    private function mapBookEntityToItem(Book $book): BookListItem
    {
        $item = new BookListItem($book->getId(), $book->translate($book->getCurrentLocale())->getTitle());
        foreach ($book->getAuthors() as $author) {
            $authorItem = new AuthorListItem($author->getId(), $author->translate($author->getCurrentLocale())->getName());
            $item->addAuthor($authorItem);
        }

        return $item;
    }

    public function getBook(int $id): ?BookListItem
    {
        /** @var Book $book */
        $book = $this->bookRepository->find($id);

        if (empty($book)) {
            throw new BookNotFoundException();
        }
        
        return $this->mapBookEntityToItem($book);
    }
}