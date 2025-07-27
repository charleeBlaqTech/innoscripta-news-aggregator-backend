<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Source extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'base_url'];

    public function articles()
    {
        return $this->hasMany(\App\Models\Article::class);
    }
}