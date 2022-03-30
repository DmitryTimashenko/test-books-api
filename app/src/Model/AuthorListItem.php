<?php

namespace App\Model;

use JMS\Serializer\Annotation as Serializer;

#[Serializer\ExclusionPolicy('all')]
class AuthorListItem
{
    #[Serializer\Expose()]
    #[Serializer\Type('integer')]
    private int $id;

    #[Serializer\Expose()]
    #[Serializer\Type('string')]
    private string $name;

    public function __construct(int $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }
}