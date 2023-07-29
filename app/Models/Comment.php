<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function post()
    {
        //Relationship 1:1
        return $this->belongsTo(Post::class);
    }

    public function author()
    {
        //Relationship 1:1 with different name for foreign key
        return $this->belongsTo(User::class,'user_id');
    }
}
