<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        Comment::create([
            'user_id' => Auth::id(),
            'post_id' => $post->id,
            'content' => $request->input('content'),
        ]);

        return back()->with('success', 'Комментарий добавлен!');
    }

    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $user = Auth::user();

        // Проверяем, является ли пользователь админом или автором комментария
        if ($user->id === $comment->user_id || $user->role === 'admin') {
            $comment->delete();
            return response()->json(['success' => true, 'message' => 'Комментарий удален.']);
        }

        return response()->json(['success' => false, 'message' => 'Удаление запрещено.'], 403);
    }

    public function update(Request $request, Comment $comment){
        // Ensure only the comment owner can edit
        if (auth()->user()->id !== $comment->user_id) {
            return response()->json(['success' => false, 'message' => 'Вы не можете редактировать этот комментарий.'], 403);
        }

        // Validate input
        $validated = $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        // Update comment
        $comment->update(['content' => $validated['content']]);

        return response()->json(['success' => true, 'message' => 'Комментарий отредактирован.']);
    }
}
