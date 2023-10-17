<?php


class Book
{
    public string $title;
    public float $price;
    public Author $author;


    // TODO Generate getters and setters of properties
    // TODO Generate constructor for all attributes. $author argument of the constructor can be optional
    /**
     * @param string $title
     * @param float $price
     * @param Author $author
     */
    public function __construct(string $title, float $price, Author $author = new Author("", []))
    {
        $this->title = $title;
        $this->price = $price;
        $this->author = $author;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    public function getAuthor(): Author
    {
        return $this->author;
    }

    public function setAuthor(Author $author): void
    {
        $this->author = $author;
    }

}