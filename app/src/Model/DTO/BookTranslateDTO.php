<?php

namespace App\Model\DTO;

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
     * @return string
     */
    public function getLanguage(): string
    {
        return $this->language;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }


}