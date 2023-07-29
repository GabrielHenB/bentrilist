{{--@extends('layout')--}}
    {{--@section('content')--}}
<x-layout :title="$title">
    <x-slot name="content">
        {{-- n deve ser necessario se eh pra mostrar so um --}}
        <x-category-dropdown />
    <?php
        if(!empty($post))
            //echo $post;
            $posts = collect([$post]);
            //Os @ indicam pro Blade atalhos que sao compilados em php nativo
            //Os !! indicam pra saida ser interpretada como html
        ?>
    @if($posts->count())

    @foreach($posts as $item)

     <x-post-card :post="$item" class="ConteinerLista" /> {{-- Calls the post blade component and passes post as variable not literal --}}

    @endforeach
    @else
            <section class="Lista">
                <div class="BoxPost">

                    <div class="PostDetalhes">
                        <p class="PostDetalhesBody">
                            Nenhum post foi encontrado no momento.
                        </p>
                    </div>

                </div>
            </section>
    @endif
    @if($post)
        <section class="Comments container">
            <!-- COMMENT MUMBO JUMBO GOES HERE -->
            <div class="comment-sec row"><h2 class="comment-sec-title col-12">Reviews</h2></div>
            <!-- a certain specific form goes here -->
            @auth
            <div class="comment-form-wrap conteiner">
                <x-comment-form :post="$post"></x-comment-form>
            </div>
            @else
            <div class="comment-form-wrap conteiner" style="text-align: center;">
                <a href="/login" class="align-content-center" style="text-decoration: none;">Logar-se</a> para comentar
            </div>
            @endauth
            <!-- Base template -->
            @foreach($item->comments as $comment)
                <x-post-comment :comment="$comment" />
            @endforeach
            <!-- Nothing then -->
            @unless($item->comments->count())
                <p style="margin: auto 0; padding: 5px;">
                    Não existem reviews no momento! </p>
            @endunless
        </section>
    @endif
    {{--@endsection--}}
    </x-slot>
</x-layout>




