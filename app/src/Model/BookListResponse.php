<?php

namespace App\Model;

use JMS\Serializer\Annotation as Serializer;

#[Serializer\ExclusionPolicy('all')]
class BookListResponse
{
    #[Serializer\Expose()]
    #[Serializer\Type("array<".BookListItem::class .">")]
    private array $items;

    /**
     * @param BookListItem[] $items
     */
    public function __construct(array $items)
    {
        $this->items = $items;
    }

    /**
     * @return BookListItem[]
     */
    public function getItems(): array
    {
        return $this->items;
    }
}