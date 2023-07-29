<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ListController extends Controller
{

    public function index()
    {
        $mangaModel = new \App\Models\Manga();
        return view('post.index', [
            'title' => 'BentriList',
            'posts' => $mangaModel->all()
        ]);
    }
}
