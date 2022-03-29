<?php

namespace App\Model\DTO;

use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

#[Serializer\ExclusionPolicy('all')]
class BookDTO
{
    #[Serializer\Expose()]
    #[Serializer\Type("array<AuthorTranslateDTO>")]
    #[Assert\NotBlank]
    private $translations;

    #[Serializer\Expose()]
    #[Serializer\Type("array<Integer>")]
    private $authors;

    public function getTranslations()
    {
        return $this->translations;
    }
    public function getAuthors()
    {
        return $this->authors;
    }
}