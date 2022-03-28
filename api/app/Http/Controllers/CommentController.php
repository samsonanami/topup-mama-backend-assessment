<?php


namespace App\Http\Controllers;

use App\Comment;
use Illuminate\Http\Request;
use App\Http\Resources\CommentResource;

class CommentController extends Controller
{
    public function index()
    {
        $comments = Comment::orderBy('created_at', 'desc')->get();
        return response()->json(CommentResource::collection($comments));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'book_id' => 'required|integer|exists:books,id',
            'comment' => 'string|required',
            'commenter_ip' => 'ip|required'
        ]);
        $comment = Comment::create($request->all());
        return response()->json(new CommentResource($comment));
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
