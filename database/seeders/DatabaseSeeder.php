<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /*
        \App\Models\User::truncate();
        \App\Models\Category::truncate();
        \App\Models\Post::truncate();
        */

        //$post = \App\Models\Post::factory(2)->create();
        \App\Models\User::factory(2)->create();
        \App\Models\Category::factory()->create(['name'=>'Manga','slug'=>'manga-sl']);
        \App\Models\Category::factory()->create(['name'=>'Show','slug'=>'show-sl']);


        \App\Models\Post::create([
            "user_id"=>'1',
            "category_id"=>'1',
            "slug"=>"post_one",
            "title"=>"Aquele dos Ninjas",
            "excerpt"=>"Descubra um novo mundo ninja",
            "body"=>"A série gira em torno das aventuras vividas por um jovem órfão habitante da Aldeia da Folha que sonha em se tornar o quinto Hokage, o maior guerreiro e governante da vila.
",
        ]);
        \App\Models\Post::create([
            "user_id"=>'2',
            "category_id"=>'1',
            "slug"=>"post_two",
            "title"=>"Aquele do Cultivador",
            "excerpt"=>"Uma historia de cultivo chinesa",
            "body"=>"LZ, now a humble slave who was born as the eldest son of a wealthy family. Due to his familys decline and the kidnapping of his sister by a powerful force, he can now only be stepped on by others. However, heaven never seals off all exits. An ancient book left by his father reveals a secret divine technique, giving the reader immense power! But what is behind this power? This is a contest against fate.'
",
        ]);
        \App\Models\Post::create([
            "user_id"=>1,
            "category_id"=>2,
            "slug"=>"post_three",
            "title"=>"Escuro",
            "excerpt"=>"Os misterios sombrios de uma pequena cidade alema sao expostos quando duas crianças desaparecem.",
            "body"=>"Os misterios sombrios de uma pequena cidade alema sao expostos quando duas crianças desaparecem.
            Enquanto as familias procuram os dois desaparecidos, eles descobrem uma trama de
            individuos conectados com a historia conturbada da cidade.",
        ]);
        \App\Models\Post::create([
            "user_id"=>2,
            "category_id"=>2,
            "slug"=>"post_four",
            "title"=>"Algumas coisas sao estranhas",
            "excerpt"=>"Um grupo de amigos se envolve em uma serie de eventos sobrenaturais na pacata cidade de Hawkins.",
            "body"=>"Um grupo de amigos se envolve em uma serie de eventos sobrenaturais na pacata cidade de Hawkins.
            Eles enfrentam criaturas monstruosas, agencias secretas do governo e se aventuram em dimensoes paralelas.",
        ]);

        \App\Models\Comment::create([
            "user_id" => 1,
            "post_id" => 1,
            "body" => "Melhor manga que eu ja li"
        ]);

        \App\Models\Comment::create([
            "user_id" => 2,
            "post_id" => 1,
            "body" => "Esse eh dos bons"
        ]);

        \App\Models\Comment::create([
            "user_id" => 1,
            "post_id" => 2,
            "body" => "Zengue eh muito bom"
        ]);

        \App\Models\Comment::create([
            "user_id" => 2,
            "post_id" => 2,
            "body" => "Achei interessante!"
        ]);

        \App\Models\Post::factory(2)->create();
        \App\Models\Comment::factory(4)->create();

        //$nuser = \App\Models\User::factory(2)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        /*
        $cat1 = \App\Models\Category::create([
            'slug' => 'manga',
            'name' => 'MangaOld'
        ]);

        $cat2 = \App\Models\Category::create([
            'slug' => 'show',
            'name' => 'Show'
        ]);

        \App\Models\Post::create([
            'category_id' => '1',
            'user_id' => '1',
            'title' => 'A manga',
            'slug' => 'post_one',
            'excerpt' => 'A little excerpt of what could be a incredible text...',
            'body' => 'Eu sou o conteudo do body do objeto criado atraves de um Seeder!'
        ]);

        \App\Models\Post::create([
            'category_id' => '1',
            'user_id' => '1',
            'title' => 'A manga',
            'slug' => 'post_two',
            'excerpt' => 'A little excerpt of what could be a incredible text...',
            'body' => 'Eu sou o conteudo do body do objeto criado atraves de um Seeder!'
        ]);

        \App\Models\Post::create([
            'category_id' => '2',
            'user_id' => '1',
            'title' => 'A show',
            'slug' => 'show_one',
            'excerpt' => 'A little excerpt of what could be a incredible text...',
            'body' => 'Eu sou o conteudo do body do objeto criado atraves de um Seeder!'
        ]);

        \App\Models\Post::create([
            'category_id' => '2',
            'user_id' => '1',
            'title' => 'A show',
            'slug' => 'show_two',
            'excerpt' => 'A little excerpt of what could be a incredible text...',
            'body' => 'Eu sou o conteudo do body do objeto criado atraves de um Seeder!'
        ]);
        */
    }
}
