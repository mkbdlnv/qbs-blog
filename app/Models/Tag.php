<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',        // русское название
        'name_en',     // английское название
        'name_kz',
    ];

    protected $appends = ['translated_name'];

    public function getTranslatedNameAttribute()
    {
        return match (app()->getLocale()) {
            'kz' => $this->name_kz ?: $this->name,
            'en' => $this->name_en ?: $this->name,
            default => $this->name,
        };
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

}
