<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;

class PostController extends Controller
{
    //Controlador para modelo Post.
    //RESTful actions: index, show, create, edit, store, update, destroy.
    /**
     * Index do Blog e mostra uma lista de posts com paginacao seguindo query scopes
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function index()
    {
        //\Illuminate\Support\Facades\DB::listen(fn($query) => logger($query->sql));

        //Chama o Modelo Post e faz query para os mais recentes de acordo com o campo published_at
        $post = Post::latest('published_at');

        /* desnecessario ja que usa query scopes no proprio model
        if(request('searchQuery')){
            //Entao teve requisicao do form
            //Filtrar e remover tags maliciosas
            $receive = htmlspecialchars(strip_tags(request('searchQuery')));
            //var_dump($receive);
            $post->where('title','like','%'.$receive.'%')
                ->orWhere('body','like','%'.$receive.'%');
        }*/
        //$post = self::getPosts();

        //Usar o latest gera um order by no sql
        //O request sendo passado no filter nao eh stripped tags e o array faz passar chave-valor com cada campo se existir
        return view('post.index',
            ['title' => 'Beloblog | All',
                'posts' => $post->latest('published_at')->filter(
                    request(['searchQuery','category','author'])
                )->with('category','author')
                    ->paginate(4)->withQueryString(),
            ]
        );
    }

    /**
     * Mostra um Post em especifico
     * @param Post $post
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function show(Post $post)
    {
        //\Illuminate\Support\Facades\DB::listen(fn($query) => logger($query->sql));

        //now its binded with Post $post
        //I can also bind a slug using getRouteKeyName() in Post
        return view('post.show', [
            'post' => $post,
            'posts' => [],
            'title' => 'Bentrilist',

        ]);
    }

    /**
     * Gera uma View que recebe um all() de Category e lista formulario de criar post
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application
     */
    public function create()
    {
        //Check authority using middleware
        //Middlewares are called every request

        $cats = \App\Models\Category::all();

        return view('post.create', compact('cats'));
    }

    /**
     * Guarda no BD uma instancia de Post, realizando as validacoes necessarias
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store()
    {
        //A bit of sanitization
        $request = request();
        foreach($request->all() as $chave=>$valor){
            $request[$chave] = filter_var($valor,FILTER_SANITIZE_SPECIAL_CHARS);
        }
        //Some additional stuff that needs validation maybe
        $request['slug'] = \Illuminate\Support\Str::slug($request['title'],'-');
        //A bit of validation
        /**
         * Title required
         * Excerpt required
         * Body required
         * Category_id required and must exist in column id in table categories
         * Slug required and must be unique in posts table
         */
        $request = $request->validate([
           'title' => 'required',
           'excerpt' => 'required',
           'body' => 'required',
           'thumbnail' => 'required|image',
           'category_id' => ['required', \Illuminate\Validation\Rule::exists('categories','id')],
            'slug' => ['required',\Illuminate\Validation\Rule::unique('posts','slug')],
        ]);
        //Additional things that dont need validation now
        $request['user_id'] = auth()->user()->id;
        $request['thumbnail'] = request()->file('thumbnail')->store('thumbnails'); //Returns URL
        //Sending it
        Post::create($request);
        return redirect('/blog')->with('successMessage','Post realizado com sucesso!!');
    }
}
