<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function like(Post $post)
    {
        $user = auth()->user();

        if ($post->isLikedByUser($user->id)) {
            // Unlike the post
            Like::where('post_id', $post->id)->where('user_id', $user->id)->delete();
            return response()->json(['message' => 'Unliked successfully']);
        }

        // Like the post
        Like::create([
            'user_id' => $user->id,
            'post_id' => $post->id,
        ]);

        return response()->json(['message' => 'Liked successfully']);
    }


    public function unlike(Post $post)
    {
        $user = Auth::user();

        // Delete like if exists
        $like = Like::where('post_id', $post->id)->where('user_id', $user->id);
        if ($like->exists()) {
            $like->delete();
            return response()->json(['message' => 'Unliked successfully']);
        }

        return response()->json(['message' => 'Not liked yet'], 400);
    }
}
