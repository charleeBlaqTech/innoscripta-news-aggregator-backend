<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPreference extends Model
{
    //

    protected $fillable = [
        'user_id',
        'preferred_source_id',
        'preferred_category_id',
        'preferred_author_id',
    ];

    // ==============I added this as well to check users that it related to==============
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
    public function source() {
        return $this->belongsTo(\App\Models\Source::class, 'preferred_source_id');
    }

    public function category() {
        return $this->belongsTo(\App\Models\Category::class, 'preferred_category_id');
    }

    public function author() {
        return $this->belongsTo(\App\Models\Author::class, 'preferred_author_id');
    }
}