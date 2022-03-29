<?php

namespace App\Model\DTO;

use App\Validator as AcmeAssert;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

#[Serializer\ExclusionPolicy('all')]
class BookDTO implements TranslatableDto
{
    #[Serializer\Expose()]
    #[Serializer\Type("array<".BookTranslateDTO::class .">")]
    #[Assert\NotBlank]
    private $translations;

    #[Serializer\Expose()]
    #[Serializer\Type("array<integer>")]
    #[AcmeAssert\ContainsAuthorIds]
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