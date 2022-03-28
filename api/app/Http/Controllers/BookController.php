<?php


namespace App\Http\Controllers;

use App\Book;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Resources\BookResource;
use OpenApi\Annotations as OA;

class BookController extends Controller
{
    /**
     * @OA\Get(
     *   path="/users",
     *   summary="Return the list of users",
     *   tags={"Hello"},
     *   @OA\Parameter(ref="#/components/parameters/get_users_request_parameter_limit"),
     *    @OA\Response(
     *      response=200,
     *      description="List of users",
     *      @OA\JsonContent(
     *        @OA\Property(
     *          property="data",
     *          description="List of users",
     *          @OA\Schema(
     *            type="array,
     *            @OA\Items(ref="#/components/schemas/UserSchema")
     *          )
     *        )
     *      )
     *    )
     * )
     */
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
