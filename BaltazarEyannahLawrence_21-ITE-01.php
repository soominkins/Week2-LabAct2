<?php
class Book {
    public $title;
    protected $author;
    private $price;

    // Constructor to initialize book properties
    public function __construct($title, $author, $price) {
        $this->title = $title;
        $this->author = $author;
        $this->price = $price;
    }

       public function getDetails() {
        return "Title: {$this->title}, Author: {$this->author}, Price: \${$this->price}";
    }

       public function setPrice($price) {
        $this->price = $price;
    }

       public function __call($name, $arguments) {
        echo "Stock updated for '{$this->title}' with arguments: " . implode(", ", $arguments) . "\n";
    }
}

// Class definition for Library
class Library {
    public $name;            // Public property accessible from outside the class
    private $books = [];     // Private array to store Book objects

    // Constructor to initialize the library name
    public function __construct($name) {
        $this->name = $name;
    }
       public function addBook(Book $book) {
        $this->books[$book->title] = $book;
    }
        public function removeBook($title) {
        if (isset($this->books[$title])) {
            unset($this->books[$title]);
            echo "Book '$title' removed from the library.\n";
        } else {
            echo "Book '$title' not found in the library.\n";
        }
    }
      public function listBooks() {
        foreach ($this->books as $book) {
            echo $book->getDetails() . "\n";
        }
    }
    // Destructor to clear the library when it's no longer needed
    public function __destruct() {
        echo "The library '{$this->name}' is now closed.\n";
    }
}
$book1 = new Book("The Great Gatsby", "F. Scott Fitzgerald", 10.99);
$book2 = new Book("1984", "George Orwell", 8.99);

$library = new Library("City Library");

$library->addBook($book1);
$library->addBook($book2);

// Update the price of a book
$book1->setPrice(12.99);

$book1->updateStock(50);

// List all books in the library
echo "Books in the library:\n";
$library->listBooks();

$library->removeBook("1984");

// List books after removal
echo "\nBooks in the library after removal:\n";
$library->listBooks();

// Destroy the Library object at the end to trigger the destructor
unset($library);
?>