<?php

namespace App\Service;

use App\Entity\Author;
use App\Model\AuthorDTO;
use App\Repository\AuthorRepository;

class AuthorService
{
    private AuthorRepository $repository;

    /**
     * @param AuthorRepository $repository
     */
    public function __construct(AuthorRepository $repository)
    {
        $this->repository = $repository;
    }

    public function create(AuthorDTO $data): Author
    {
        $author = new Author();
        foreach ($data->getTranslations() as $translation) {
            $author->translate($translation->getLanguage())->setName($translation->getName());
        }
        $this->repository->add($author);
        return $author;
    }
}