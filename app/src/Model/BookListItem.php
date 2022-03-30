<?php

namespace App\Model;

use JMS\Serializer\Annotation as Serializer;

#[Serializer\ExclusionPolicy('all')]
class BookListItem
{
    private int $id;

    #[Serializer\Expose()]
    #[Serializer\Type('string')]
    private string $title;

    #[Serializer\Expose()]
    #[Serializer\Type("array<".AuthorListItem::class .">")]
    private array $authors = [];

    public function __construct(int $id, string $title)
    {
        $this->id = $id;
        $this->title = $title;
    }

    public function addAuthor(AuthorListItem $author): void
    {
        $this->authors[] = $author;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return AuthorListItem[]
     */
    public function getAuthors(): array
    {
        return $this->authors;
    }
}