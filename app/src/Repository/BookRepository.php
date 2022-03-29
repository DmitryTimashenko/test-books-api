<?php

namespace App\Repository;

use App\Entity\Book;
use App\Model\DTO\BookTranslateDTO;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class BookRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Book::class);
    }

    public function add(Book $book): void
    {
        $this->_em->persist($book);
        $book->mergeNewTranslations();
        $this->_em->flush();
    }
}