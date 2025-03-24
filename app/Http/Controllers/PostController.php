<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function getPosts(Request $request)
    {
        $search = $request->query('search');
        $tags = $request->query('tags');
        $perPage = 5; // Количество постов на страницу

        $posts = Post::when($search, function ($query, $search) {
            return $query->where('title', 'like', "%$search%");
        })
            ->when($tags, function ($query, $tags) {
                if ($tags) {
                    $tagNames = explode(',', $tags);
                    return $query->whereHas('tags', function ($q) use ($tagNames) {
                        $q->whereIn('name', $tagNames);
                    });
                }
            })
            ->with(['likes', 'comments', 'comments.user', 'tags']) // Eager load relationships
            ->latest()
            ->paginate($perPage);


        $posts->through(function ($post) {
            return [
                'id' => $post->id,
                'title' => $post->title,
                'content' => $post->content,
                'created_at' => $post->created_at->diffForHumans(),
                'is_authenticated' => Auth::check(),
                'is_liked' => Auth::check() ? $post->isLikedByUser(Auth::id()) : false,
                'likes_count' => $post->likes->count(),
                'tags' => $post->tags->pluck('name')->toArray() // Ensure tags are returned as an array
            ];
        });

        return response()->json($posts);
    }

}
