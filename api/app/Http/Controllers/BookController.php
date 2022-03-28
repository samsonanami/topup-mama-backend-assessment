<?php


namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;
use App\Http\Resources\BookResource;
use App\Traits\ApiResponse;

/**
 * 
 * @group 1.Books APIs
 * 
 */
class BookController extends Controller
{
    use ApiResponse;
    /**
     * 
     * List Books
     * 
     * This endpoint display a listing of all the books.
     * <aside class="notice">No paramater is required</aside>
     * 
     * @response {
     * 
     * @response
     * {
     *   "status": 200,
     *   "message": "Books found!",
     *   "data": [
     *       {
     *           "id": 2,
     *           "name": "A Game of Thrones",
     *           "isbn": "978-0553103540",
     *           "authors": "[\"George R. R. Martin\"]",
     *            "character_id": 1,
     *            "pov_character_id": 1,
     *            "numberOfPages": 694,
     *            "publisher": "Bantam Books",
     *            "country": "United States",
     *            "mediaType": "Hardcover",
     *            "released": "1996-08-01 00:00:00",
     *            "comment_count": 0,
     *            "povCharacters": [],
     *            "characters": [],
     *            "comments": [],
     *            "created_at": "2022-03-27T19:41:09.000000Z",
     *            "updated_at": "2022-03-27T19:41:09.000000Z"
     *        },
     *        {
     *            "id": 5,
     *            "name": "A Game of Thrones",
     *            "isbn": "978-0553103540",
     *            "authors": "[\"George R. R. Martin\"]",
     *            "character_id": 1,
     *            "pov_character_id": 1,
     *            "numberOfPages": 694,
     *            "publisher": "Bantam Books",
     *            "country": "United States",
     *            "mediaType": "Hardcover",
     *            "released": "1996-08-01 00:00:00",
     *            "comment_count": 0,
     *            "povCharacters": [],
     *            "characters": [],
     *            "comments": [],
     *            "created_at": "2022-03-28T11:24:15.000000Z",
     *            "updated_at": "2022-03-28T11:24:15.000000Z"
     *        }
     *    ]
     *}
     */
    public function index()
    {
        $books = Book::orderBy('released', 'asc')->get();
        return $this->successResponse(BookResource::collection($books), 'Books found!', 200);
    }
    /**
     * 
     * Create Books
     *
     * This endpoint allows you to add a new book to the list. 
     * 
     * @bodyParam name string required The name of the book. Example: A Game of Thrones
     * @bodyParam isbn string The isbn number of the book. Example: 978-0553103540
     * @bodyParam authors array List of authors of the book. Example: ["George R. R. Martin"]
     * @bodyParam numberOfPages number Number of pages in the book. Example: 694
     * @bodyParam publisher string The book's publisher. Example: Bantam Books
     * 
     * @response
     * {
     *    "status": 200,
     *    "message": "Book created!",
     *    "data": {
     *        "id": 7,
     *        "name": "A Game of Thrones",
     *        "isbn": "978-0553103540",
     *        "authors": "[\"George R. R. Martin\"]",
     *        "character_id": "1",
     *        "pov_character_id": "1",
     *        "numberOfPages": "694",
     *        "publisher": "Bantam Books",
     *        "country": "United States",
     *        "mediaType": "Hardcover",
     *        "released": "1996-08-01T00:00:00",
     *        "comment_count": 0,
     *        "povCharacters": [],
     *        "characters": [],
     *        "comments": [],
     *        "created_at": "2022-03-28T16:47:12.000000Z",
     *        "updated_at": "2022-03-28T16:47:12.000000Z"
     *    }
     *}
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
        return $this->successResponse(new BookResource($book), 'Book created!', 200);
    }
    /**
     * 
     * Show Books
     *
     * This endpoint show a book by ID. 
     * 
     * @queryParam id integer required The unique ID of a book. Example: 2
     * 
     * @response
     * {
     *    "status": 200,
     *    "message": "Book found!",
     *    "data": {
     *        "id": 2,
     *        "name": "A Game of Thrones",
     *        "isbn": "978-0553103540",
     *        "authors": "[\"George R. R. Martin\"]",
     *        "character_id": 1,
     *        "pov_character_id": 1,
     *        "numberOfPages": 694,
     *        "publisher": "Bantam Books",
     *        "country": "United States",
     *        "mediaType": "Hardcover",
     *        "released": "1996-08-01 00:00:00",
     *        "comment_count": 2,
     *        "povCharacters": [],
     *        "characters": [],
     *        "comments": [
     *            {
     *                "id": 3,
     *                "book_id": 2,
     *                "comment": "Test comment",
     *                "commenter_ip": "192.168.1.112",
     *                "created_at": "2022-03-28T11:27:13.000000Z",
     *                "updated_at": "2022-03-28T11:27:13.000000Z"
     *            },
     *            {
     *                "id": 4,
     *                "book_id": 2,
     *                "comment": "Test comment one",
     *                "commenter_ip": "192.168.1.112",
     *                "created_at": "2022-03-28T11:32:14.000000Z",
     *                "updated_at": "2022-03-28T11:32:14.000000Z"
     *            }
     *        ],
     *        "created_at": "2022-03-27T19:41:09.000000Z",
     *        "updated_at": "2022-03-27T19:41:09.000000Z"
     *    }
     *}
     */
    public function show($id)
    {
        $book = Book::find($id);
        return $this->successResponse(new BookResource($book), 'Book found!', 200);
    }
    /**
     * 
     * Update Book
     *
     * This endpoint updates a book by ID. 
     * 
     * @queryParam id integer required The unique ID of a book. Example: 2
     * @bodyParam name string required The name of the book. Example: A Game of Thrones
     * @bodyParam isbn string The isbn number of the book. Example: 978-0553103540
     * @bodyParam authors array List of authors of the book. Example: ["George R. R. Martin"]
     * @bodyParam numberOfPages number Number of pages in the book. Example: 694
     * @bodyParam publisher string The book's publisher. Example: Bantam Books
     * 
     * @response
     * {
     *    "status": 200,
     *    "message": "Book updated!",
     *    "data": {
     *        "id": 2,
     *        "name": "A Game of Thrones",
     *        "isbn": "978-0553103540",
     *        "authors": "[\"George R. R. Martin\"]",
     *        "character_id": "1",
     *        "pov_character_id": "1",
     *        "numberOfPages": "694",
     *        "publisher": "Bantam Books",
     *        "country": "United States",
     *        "mediaType": "Hardcover",
     *        "released": "1996-08-01T00:00:00",
     *        "comment_count": 2,
     *        "povCharacters": [],
     *        "characters": [],
     *        "comments": [
     *            {
     *                "id": 3,
     *                "book_id": 2,
     *                "comment": "Test comment",
     *                "commenter_ip": "192.168.1.112",
     *                "created_at": "2022-03-28T11:27:13.000000Z",
     *                "updated_at": "2022-03-28T11:27:13.000000Z"
     *            },
     *            {
     *                "id": 4,
     *                "book_id": 2,
     *                "comment": "Test comment one",
     *                "commenter_ip": "192.168.1.112",
     *                "created_at": "2022-03-28T11:32:14.000000Z",
     *                "updated_at": "2022-03-28T11:32:14.000000Z"
     *            }
     *        ],
     *        "created_at": "2022-03-27T19:41:09.000000Z",
     *        "updated_at": "2022-03-28T16:55:37.000000Z"
     *    }
     *}
     */
    public function update(Request $request, $id)
    {
        $book = Book::find($id);
        $book->update($request->all());
        return $this->successResponse(new BookResource($book), 'Book updated!', 200);
    }
    /**
     * 
     * Delete Book
     *
     * This endpoint delete a book by ID. 
     * 
     * @queryParam id integer required The unique ID of a book. Example: 2
     * 
     * @response
     * {
     *    "status": 200,
     *    "message": "Book deleted!",
     *    "data": {
     *        "id": 2,
     *        "name": "A Game of Thrones",
     *        "isbn": "978-0553103540",
     *        "authors": "[\"George R. R. Martin\"]",
     *        "character_id": 1,
     *        "pov_character_id": 1,
     *        "numberOfPages": 694,
     *        "publisher": "Bantam Books",
     *        "country": "United States",
     *        "mediaType": "Hardcover",
     *        "released": "1996-08-01 00:00:00",
     *        "comment_count": 2,
     *        "povCharacters": [],
     *        "characters": [],
     *        "comments": [
     *            {
     *                "id": 3,
     *                "book_id": 2,
     *                "comment": "Test comment",
     *                "commenter_ip": "192.168.1.112",
     *                "created_at": "2022-03-28T11:27:13.000000Z",
     *                "updated_at": "2022-03-28T11:27:13.000000Z"
     *            },
     *            {
     *                "id": 4,
     *                "book_id": 2,
     *                "comment": "Test comment one",
     *                "commenter_ip": "192.168.1.112",
     *                "created_at": "2022-03-28T11:32:14.000000Z",
     *                "updated_at": "2022-03-28T11:32:14.000000Z"
     *            }
     *        ],
     *        "created_at": "2022-03-27T19:41:09.000000Z",
     *        "updated_at": "2022-03-27T19:41:09.000000Z"
     *    }
     *}
     */
    public function destroy($id)
    {
        $book = Book::find($id);
        $book->delete();
        return $this->successResponse(new BookResource($book), 'Book deleted!', 200);
    }
}
