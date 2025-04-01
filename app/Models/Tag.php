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
    ];

    protected $appends = ['translated_name'];

    public function getTranslatedNameAttribute()
    {
        return app()->getLocale() === 'ru' ? $this->name : ($this->name_en ?: $this->name);
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

}
