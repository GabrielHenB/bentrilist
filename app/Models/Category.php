<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function posts(): mixed
    {
        //Eloquent makes the SQL querie and returns Posts
        return $this->hasMany(\App\Models\Post::class);
    }
}
