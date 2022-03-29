<?php

namespace App\Model\DTO;

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
     * @return AuthorTranslateDTO[]
     */
    public function getTranslations(): array
    {
        return $this->translations;
    }


}