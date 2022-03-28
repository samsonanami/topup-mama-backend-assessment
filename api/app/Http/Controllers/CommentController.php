<?php


namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use App\Http\Resources\CommentResource;
use App\Traits\ApiResponse;

/**
 * 
 * @group 3.Comments APIs
 * 
 */
class CommentController extends Controller
{
    use ApiResponse;
    /**
     * 
     * List Comments
     * 
     * This endpoint display a listing of all the book comments.
     * 
     * @response {
     * {
     *    "status": 200,
     *    "message": "Comments Found!",
     *    "data": [
     *        {
     *            "book_id": 2,
     *            "comment": "Test comment one",
     *            "commenter_ip": "192.168.1.112",
     *            "created_at": "2022-03-28T11:32:14.000000Z"
     *        },
     *        {
     *            "book_id": 2,
     *            "comment": "Test comment",
     *            "commenter_ip": "192.168.1.112",
     *            "created_at": "2022-03-28T11:27:13.000000Z"
     *        }
     *    ]
     *}
     */
    public function index()
    {
        $comments = Comment::orderBy('created_at', 'desc')->get();
        return $this->successResponse(CommentResource::collection($comments), 'Comments Found!', 200);
    }
    /**
     * 
     * Create Comment
     * 
     * This endpoint creates/store a comment for a book.
     * 
     * @response {
     * {
     *    "status": 200,
     *    "message": "Comment created!",
     *    "data": {
     *        "book_id": "2",
     *        "comment": "Test comment one",
     *        "commenter_ip": "192.168.1.112",
     *        "created_at": "2022-03-28T11:32:14.000000Z"
     *    }
     *}
     * @bodyParam book_id integer required The books id from books table fro which comment is made. Example: 2
     * @bodyParam comment string The comment detail or message itself.
     * @bodyParam commenter_ip ipAddress The IP address of the commenter. Example: 192.168.1.112
     * 
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'book_id' => 'required|integer|exists:books,id',
            'comment' => 'string|required',
            'commenter_ip' => 'ip|required'
        ]);
        if ($comment = Comment::create($request->all()))
            return $this->successResponse(new CommentResource($comment), 'Comment created!', 200);
        else
            return $this->errorResponse('Comment not created!', 500, []);
    }
    public function show($id)
    {
        $comment = Comment::find($id);
        return response()->json(new CommentResource($comment));
    }
    public function update(Request $request, $id)
    {
        $comment = Comment::find($id);
        $comment->update($request->all());
        return response()->json(new CommentResource($comment));
    }
    public function destroy($id)
    {
        $comment = Comment::find($id);
        $comment->delete();
        return response()->json('Item deleted successfully');
    }
}
