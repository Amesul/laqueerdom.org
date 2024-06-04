<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $attributes = $request->validate([
            'message' => ['required', 'max:300', 'string'],
            'user_id' => ['required', 'exists:users,id'],
            'document_id' => ['required', 'exists:documents,id'],
        ]);

        Comment::create($attributes);

        return back()->with('success', 'Commentaire posté.');
    }

    /**
     * @param Comment $comment
     * @return RedirectResponse
     * Delete specified comment
     */
    public function destroy(Comment $comment): RedirectResponse
    {
        $comment->delete();

        return back()->with('danger', 'Commentaire supprimé.');
    }
}
