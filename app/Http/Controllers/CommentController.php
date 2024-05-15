<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index()
    {
        return Comment::all();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id' => ['required', 'exists:users'],
            'document_id' => ['required', 'exists:documents'],
            'message' => ['required'],
        ]);

        return Comment::create($data);
    }

    public function show(Comment $comment)
    {
        return $comment;
    }

    public function update(Request $request, Comment $comment)
    {
        $data = $request->validate([
            'user_id' => ['required', 'exists:users'],
            'document_id' => ['required', 'exists:documents'],
            'message' => ['required'],
        ]);

        $comment->update($data);

        return $comment;
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();

        return response()->json();
    }
}