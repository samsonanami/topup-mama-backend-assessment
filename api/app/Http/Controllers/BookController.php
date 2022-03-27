<?php


namespace App\Http\Controllers;

use App\Book;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Resources\BookResource;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::orderBy('released', 'asc')->get();
        return response()->json(BookResource::collection($books));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'isbn' => 'required|string',
            'authors' => 'required|json',
            'publisher' => 'required|string',
            'country' => 'string',
            'mediaType' => 'string',
            'released' => 'string'
        ]);
        $book = Book::create($request->all());
        return response()->json(new BookResource($book));
    }
    public function show($id)
    {
        $book = Book::find($id);
        return response()->json(new BookResource($book));
    }
    public function update(Request $request, $id)
    {
        $book = Book::find($id);
        $book->update($request->all());
        return response()->json(new BookResource($book));
    }
    public function destroy($id)
    {
        $book = Book::find($id);
        $book->delete();
        return response()->json('Item deleted successfully');
    }
}
