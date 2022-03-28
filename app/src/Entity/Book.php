<?php

namespace App\Entity;

use App\Repository\BookRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Knp\DoctrineBehaviors\Contract\Entity\TranslatableInterface;
use Knp\DoctrineBehaviors\Model\Translatable\TranslatableTrait;

#[ORM\Entity(repositoryClass: BookRepository::class)]
class Book implements TranslatableInterface
{
    use TranslatableTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToMany(targetEntity: Author::class)]
    #[ORM\JoinTable(name: "book_author")]
    #[ORM\JoinColumn(name: "book_id", referencedColumnName: "id")]
    #[ORM\InverseJoinColumn(name: "author_id", referencedColumnName: "id")]
    private $authors;

    public function __construct() {
        $this->authors = new ArrayCollection();
    }

    public function addAuthor(Author $author)
    {
        $this->authors->add($author);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthors(): ArrayCollection
    {
        return $this->authors;
    }
}