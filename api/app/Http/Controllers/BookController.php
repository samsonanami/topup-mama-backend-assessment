<?php


namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;
use App\Http\Resources\BookResource;

/**
 * 
 * @group Books APIs
 * 
 */
class BookController extends Controller
{
    /**
     * 
     * GET Books
     * 
     * Display a listing of the books.
     *
     * @return \Illuminate\Http\Response
     * 
     */
    public function index()
    {
        $books = Book::orderBy('released', 'asc')->get();
        return response()->json(BookResource::collection($books));
    }
    /**
     * Add a word to the list.
     *
     * This endpoint allows you to add a word to the list. It's a really useful endpoint,
     * and you should play around with it for a bit.
     * <aside class="notice">We mean it; you really should.😕</aside>
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'isbn' => 'required|string',
            'authors' => 'required|json',
            'publisher' => 'required|string',
            'country' => 'string',
            'mediaType' => 'string',
            'released' => 'string',
            'character_id' => 'integer|required|exists:characters,id',
            'pov_character_id' => 'integer|required|exists:characters,id'
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
