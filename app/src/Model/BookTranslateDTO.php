<?php

namespace App\Model;

use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

#[Serializer\ExclusionPolicy('all')]
class BookTranslateDTO
{
    #[Serializer\Expose()]
    #[Serializer\Type('string')]
    #[Assert\NotBlank]
    private string $language;

    #[Serializer\Expose()]
    #[Serializer\Type('string')]
    #[Assert\NotBlank]
    private string $title;

    /**
     * @param string $language
     * @param string $title
     */
    public function __construct(string $language, string $title)
    {
        $this->language = $language;
        $this->title = $title;
    }


    public function getLanguage(): string
    {
        return $this->language;
    }

    public function getTitle(): string
    {
        return $this->title;
    }
}