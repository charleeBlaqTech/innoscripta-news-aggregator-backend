<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'url',
        'source_id',
        'category_id',
        'author_id',
        'published_at',
    ];

    public function source()
    {
        return $this->belongsTo(\App\Models\Source::class);
    }

    public function category()
    {
        return $this->belongsTo(\App\Models\Category::class);
    }

    public function author()
    {
        return $this->belongsTo(\App\Models\Author::class);
    }
}