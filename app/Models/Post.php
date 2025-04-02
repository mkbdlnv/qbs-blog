<?php

namespace App\Models;

use App\Notifications\NewPostNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory, SoftDeletes;


    protected $fillable = ['title', 'content', 'title_en', 'content_en', 'title_kz', 'content_kz', 'slug', 'image'];
    protected $appends = ['translated_title', 'translated_content'];
    public function getTranslatedTitleAttribute()
    {
        return match (app()->getLocale()) {
            'kz' => $this->title_kz ?: $this->title,
            'en' => $this->title_en ?: $this->title,
            default => $this->title,
        };
    }

    public function getTranslatedContentAttribute()
    {
        return match (app()->getLocale()) {
            'kz' => $this->content_kz ?: $this->content,
            'en' => $this->content_en ?: $this->content,
            default => $this->content,
        };
    }



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
