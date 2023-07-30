<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /** @var string[] the same as $safe it stops mass assignemnt to those */
    protected $guarded = ['id','created_at','updated_at','published_at'];

    //Garante que sempre requisicoes a Post usem eager loading nesses relacionamentos
    //protected $with = ['category','author'];


    public function scopeFilter($query, array $filters)
    {
        //The $query comes automatically from laravel components (it is a Builder from Eloquent)
        $query->when($filters['searchQuery'] ?? false, function ($query, $searchQuery) {
            //Entao teve requisicao do form
            //Filtrar e remover tags maliciosas
            $receive = htmlspecialchars(strip_tags($searchQuery));
            //var_dump($receive);
            //Obs: o where inicial serve pra agrupar o where (xory)and ao inves de (x or y and )
            $query->where(fn($query)=>
            $query->where('title','like','%'.$receive.'%')
                ->orWhere('body','like','%'.$receive.'%'));
        });

        $query->when($filters['category'] ?? false, function ($query, $category) {
            //Entao teve requisicao do form
            //Filtrar e remover tags maliciosas


            /* first example it works
            $query->whereExists(fn($query) => $query->from('categories')
                ->whereColumn('categories.id','posts.category_id')
                ->where('categories.slug', $receive)
            );
            */
            //using whereHas example also works
            $query->whereHas('category', fn($query) =>
            $query->where('slug',htmlspecialchars(strip_tags($category)))
            );


            /* old query way
            $query->where('title','like','%'.$receive.'%')
                ->orWhere('body','like','%'.$receive.'%');
            */
        });

        $query->when($filters['author'] ?? false, fn($query,$author)=>
            $query->whereHas('author', fn($query) =>
                $query->where('username',htmlspecialchars(strip_tags($author)))));
    }

    /**
     * Get the route key for the model.
     * Isso muda o comportamento do Route Binding que agora espera slug ao inves do default id
     * @return string
     */
    public function getRouteKeyName(): string
    {
        //Will return the equivalent slug thingy
        return 'slug';
    }

    /**
     * Metodo associa relacionamento belongsTo a modele Category
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        //Uses Eloquent for the querie abstraction
        return $this->belongsTo(\App\Models\Category::class);
    }

    /**
     * Associa relacionamento Post Usuario pela chave user_id especificada
     * e como o nome do metodo eh diferente de user eh necessario especificar no argumento de belongsTo()
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function author()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
