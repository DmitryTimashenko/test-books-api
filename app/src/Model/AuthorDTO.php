<?php

namespace App\Model;

use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

#[Serializer\ExclusionPolicy('all')]
class AuthorDTO implements TranslatableDto
{
    #[Serializer\Expose()]
    #[Serializer\Type("array<".AuthorTranslateDTO::class .">")]
    #[Assert\NotBlank]
    private $translations;

    /**
     * @param AuthorTranslateDTO[] $translations
     */
    public function __construct($translations)
    {
        $this->translations = $translations;
    }

    /**
     * @return AuthorTranslateDTO[]
     */
    public function getTranslations(): array
    {
        return $this->translations;
    }


}