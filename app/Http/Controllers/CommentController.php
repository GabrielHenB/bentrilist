<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    //Control comments aside from a Posts Controller separating responsabilities

    public function store(Post $post, Request $request)
    {
        //filter
        foreach($request->all() as $chave=>$valor){
            $request[$chave] = filter_var($valor,FILTER_SANITIZE_SPECIAL_CHARS);
        }
        //validate
        $request->validate([
            'commentFormTextarea' => 'required'
        ]);
        //create
        $post->comments()->create([
            'user_id' => $request->user()->id,
            'body' => $request->input('commentFormTextarea')
        ]);
        //redirect
        return back()->with('successMessage','Avaliação aceita!');
    }

}
