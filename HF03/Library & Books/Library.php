<?php
require_once "AbstractLibrary.php";

class Library extends AbstractLibrary
{
    // TODO Implement all the methods declared in AbstractLibrary class
    public function addAuthor(string $authorName): Author
    {
        // TODO: Implement addAuthor() method.
        $newAuthor = new Author($authorName);

        $newArray = $this->getAuthors();
        $newArray[] = $newAuthor;
        $this->setAuthors($newArray);

        return $newAuthor;
    }

    public function addBookForAuthor($authorName, Book $book): void
    {
        // TODO: Implement addBookForAuthor() method.
        foreach ($this->getAuthors() as $author) {
            if ($author->getName() === $authorName) {
                $author->addBook($book->getTitle(), $book->getPrice());
                $book->setAuthor($author);
            }
        }
    }

    public function getBooksForAuthor($authorName): void
    {
        // TODO: Implement getBooksForAuthor() method.
        // TODO: return Book[] ?
        foreach ($this->getAuthors() as $author) {
            if ($author->getName() === $authorName) {
                print_r($author->getBooks());
            }
        }
    }

    public function search(string $bookName): Book
    {
        $book = new Book($bookName, 10);
        // TODO: !!!

        foreach ($this->getAuthors() as $author) {
            $books = $author->getBooks();
            foreach ($books as $book) {
                if ($bookName === $book->getTitle()) {
                    return $book;
                }
            }
        }
        return $book;
        // TODO: Implement search() method.

    }

    public function print(): void
    {
        // TODO: Implement print() method.
        foreach ($this->getAuthors() as $author) {
            echo $author->getName() . "<br>";
            echo "----------------------------------------------------<br>";
            foreach ($author->getBooks() as $book) {
                echo $book->getTitle() . " - " . $book->getPrice() . "<br>";
            }
            echo "<br>";
        }
    }
}