<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookExport extends Model
{
    public $id;
    public $title;
    public $isbn;
    public $price;
    public $category;
    public $author;

    public function __construct(Book $book, $attributes = array())
    {
        parent::__construct($attributes);

        $this->id = $book->id;
        $this->title = $book->title;
        $this->isbn = $book->isbn;
        $this->price = $book->price;
        $this->category = $book->category->name;
        $this->author = $book->author->name;
    }
}
