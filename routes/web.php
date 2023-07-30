<?php

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('newone', [
        "title" => 'Bentrilist'
    ]);
});
Route::get('/home', [App\Http\Controllers\PostController::class,"index"]);
Route::get('/terms', fn()=>view('terms',['title'=>'Bl - Termos de Uso']));

/*
 * all() loads late and results in N+1 selects when relationships are applied
Route::get('/blog', fn() => view('blog', ['title' => 'Bentrilist', 'posts' => \App\Models\Post::all()]));
*/
//Moved into PostController and then I need to pass its class path (namespace thingy) and the method
Route::get('/blog', [App\Http\Controllers\PostController::class,"index"]
)->name('home');

/*
 * SEM ROUTE BINDING NO ELOQUENT ENTITY
Route::get('posts/{post}', function ($slug) {
    //\App\Models\Post::clear_posts_cache();
    $wants = \App\Models\Post::find($slug);

    return view('post', [
       'post' => $wants,
        'posts' => [],
        'title' => 'Bentrilist'
    ]);
})->where('post', "[A-z_\-]+");
*/


/**
 * BLOG 'POST' ROUTE
 * Returns a view with one specific post
 * Uses implicit Model Route binding, and understands that since {post} is given
 * it will query trying to find a post Model if a unique slug is passed through
 */
Route::get('posts/{post}', [App\Http\Controllers\PostController::class,'show'])->name('aPost');

/**
 * BLOG COMMENT STORE ROUTE
 * Nesse explicitamente indicamos que a propriedade slug de um Model Post sera usada
 */
Route::post('posts/{post:slug}/comment', [App\Http\Controllers\CommentController::class, 'store']);

/*   weird test
Route::get('all', function () {
   return view('post', ['posts' => \App\Models\MangaOld::all(), 'title' => 'Laraferst']);
});
*/


//Esses nao sao mais usados quando os posts vem do componente post-card
//Ao inves disso o model Post suporta ?author= e ?category= algo
Route::get('categories/{cat:slug}', function (App\Models\Category $cat) {
    //\Illuminate\Support\Facades\DB::listen(fn($query) => logger($query->sql));
    //Binds {cat} to a Category model
    //this one is generating n+1 queries for each thingy if staus $cat->posts
    return view('post.show', [
       'posts' => $cat->posts->load('category','author'),
       'title' => 'Bl - Cats',
        'categories' => \App\Models\Category::all()
    ]);
});

Route::get('/u/{user:username}', function (\App\Models\User $user){
    //The load method tries to prevent n+1 problem in query
    return view('post.show', [
        'title' => "Bl - Posts by {$user->username}",
        'posts' => $user->posts->load('category', 'author'),
        'categories' => \App\Models\Category::all()
    ]);
} );

/**
 * SESSION AND LOGIN ROUTES
 */

//The middleware guest redirects to the const HOME defined inside RouteServiceProvider
//Happens if not logged in the actual session
Route::get('register', [App\Http\Controllers\RegisterController::class, 'create'])->middleware('guest');
Route::post('register',[App\Http\Controllers\RegisterController::class, 'store'])->middleware('guest');
Route::get('/login',[App\Http\Controllers\SesController::class, 'create'])->middleware('guest');
Route::get('/logout',[App\Http\Controllers\SesController::class, 'destroy'])->middleware('auth'); //Only logged
Route::post('/login',[App\Http\Controllers\SesController::class, 'store']);

//Isso usa o middleware AdminCheck.php para checar se o auth eh logado e eh um admin
//Obs: O {post:id} se deve ao fato de ter usado o getRouteKeyName no model Post mudando o bind esperado default id
Route::middleware('admin')->group(function () {
    Route::get('/adm/posts/create', 'App\Http\Controllers\PostController@create');
    Route::post('/adm/posts/create',[App\Http\Controllers\PostController::class,'store']);
    Route::get('/adm/dashboard',[App\Http\Controllers\PostController::class,'dashboard']);
    Route::get('/adm/posts/edit/{post}',[App\Http\Controllers\PostController::class,'edit']);
    Route::patch('/adm/posts/edit/{post:id}',[App\Http\Controllers\PostController::class,'update']);
    Route::delete('/adm/posts/delete/{post:id}',[App\Http\Controllers\PostController::class,'destroy']);
});

