<?php

namespace App\Model;

use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

#[Serializer\ExclusionPolicy('all')]
class AuthorTranslateDTO
{
    #[Serializer\Expose()]
    #[Serializer\Type('string')]
    #[Assert\NotBlank]
    private string $language;

    #[Serializer\Expose()]
    #[Serializer\Type('string')]
    #[Assert\NotBlank]
    private string $name;

    public function getLanguage(): string
    {
        return $this->language;
    }

    public function getName(): string
    {
        return $this->name;
    }
}