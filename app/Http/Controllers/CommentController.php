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

        return response()->json(['success' => true, 'message' => 'Комментарий написан.']);
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

    public function getComments($postId)
    {
        $comments = Comment::where('post_id', $postId)
            ->with(['user', 'likes'])
            ->latest()
            ->get()
            ->map(function ($comment) {
                return [
                    'id' => $comment->id,
                    'content' => $comment->content,
                    'user_name' => $comment->user->name,
                    'created_at' => $comment->created_at->diffForHumans(),
                    'updated_at' => $comment->updated_at->diffForHumans(),
                    'edited' => $comment->created_at != $comment->updated_at,
                    'is_authenticated' => Auth::check(),
                    'is_liked' => Auth::check() ? $comment->isLikedByUser(Auth::id()) : false,
                    'likes_count' => $comment->likes->count(),
                    'can_edit' => Auth::check() && (Auth::id() === $comment->user_id || Auth::user()->role === 'admin'),
                ];
            });

        return response()->json($comments);
    }
}
