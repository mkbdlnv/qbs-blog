<?php

namespace App\Models;

use App\Notifications\NewPostNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;


    protected $fillable = ['title', 'content', 'slug'];


    protected static function boot()
    {
        parent::boot();

        static::creating(function ($post) {
            if (empty($post->slug)) {
                $post->slug = Str::slug($post->title);
            }
        });

        static::created(function ($post) {
            $subscribers = Subscriber::all();
            foreach ($subscribers as $subscriber) {
                $subscriber->notify(new NewPostNotification($post));
            }
        });
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }


    public function isLikedByUser($userId)
    {
        return $this->likes()->where('user_id', $userId)->exists();
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }


}
