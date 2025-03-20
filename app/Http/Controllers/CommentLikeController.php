<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\CommentLike;
use Illuminate\Http\Request;

class CommentLikeController extends Controller
{
    public function toggleLike(Request $request, $commentId)
    {
        $user = auth()->user();
        $comment = Comment::findOrFail($commentId);

        // Проверяем, лайкал ли пользователь уже этот комментарий
        $existingLike = CommentLike::where('user_id', $user->id)->where('comment_id', $comment->id)->first();

        if ($existingLike) {
            $existingLike->delete(); // Удаляем лайк, если он уже есть (анлайк)
            return response()->json(['message' => 'Unliked successfully', 'liked' => false, 'likes_count' => $comment->likes()->count()]);
        } else {
            CommentLike::create(['user_id' => $user->id, 'comment_id' => $comment->id]);
            return response()->json(['message' => 'Liked successfully', 'liked' => true, 'likes_count' => $comment->likes()->count()]);
        }
    }

}
