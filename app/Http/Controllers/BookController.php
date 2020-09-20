<?php

namespace App\Http\Controllers;

use App\Author;
use App\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\VarDumper\VarDumper;

class BookController extends Controller
{
    public function create(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'isbn' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required',
            'author_id' => 'required',
        ]);
        $data = $request->all();
        $author = Author::whereName($data['author_id'])->get();
        if (count($author) == 0) {
            $author = new Author();
            $author->name = $data['author_id'];
            $author->save();
        } else {
            $author = $author[0];
        }

        $book = new Book($request->all());
        $book->author_id = $author->id;
        $book->save();
        $notification = array(
            'message' => 'Kniha bola úspešne pridaná.',
            'alert-type' => 'success',
        );
        return redirect()->back()->with($notification);
    }

    public function getAutocompleteData(Request $request)
    {
        $term = $request->get('term');
        $data = DB::table('authors')->where("name", "LIKE", "%$term%")->get();
        foreach ($data as $result) {
            $results[] = ['value' => $result->name, 'id' => $result->id];
        }
        if (count($results))
            return $results;
        else
            return ['value' => 'No Result Found', 'id' => ''];
    }

    public function getJSON()
    {
        $books = Book::with('category')->with('author')->get();
        header('Content-disposition: attachment; filename=books.json');
        header('Content-Type: application/json');
        echo $books->toJson(JSON_PRETTY_PRINT);
    }


}
