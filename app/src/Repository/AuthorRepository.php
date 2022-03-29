<?php

namespace App\Repository;

use App\Entity\Author;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class AuthorRepository extends ServiceEntityRepository
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Author::class);
    }

    public function add(Author $author): void
    {
         $this->_em->persist($author);
         $author->mergeNewTranslations();
         $this->_em->flush();
    }

    public function findOneByName(string $name): ?Author
    {
        $qb = $this->createQueryBuilder('a')
            ->select('a')
            ->join('a.translations', 't')
            ->where('t.name = :name')
            ->setParameter('name', $name);

        return $qb->getQuery()->getSingleResult();
    }
}