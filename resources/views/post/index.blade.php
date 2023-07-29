{{--@extends('layout')--}}
<x-layout :title="$title">
{{--@section('content')--}}
<x-slot name="content">
    <x-category-dropdown />
    @if($posts->count())
    @foreach($posts as $item)
        <x-post-card :post="$item" class="ConteinerLista" /> {{-- Calls the post blade component and passes post as variable not literal --}}

        {{--<section class="Lista">
            <div class="BoxManga">
                <div class="MangaThumb">
                    <a href="posts/{{$item->slug}}">
                        <img src="/manga2.jpg" alt="thumb">
                    </a>
                </div>
                <div class="MangaTitulo">
                    <h2 class="MangaTitulo">
                        <a style="text-decoration: none; color:inherit;" href="posts/{{$item->slug}}">
                            {{$item->title}}
                        </a>
                    </h2>
                </div>
                <div class="MangaDetalhes">
                    <p class="MangaDetalhes">
                        {!! $item->excerpt !!}
                    </p>
                </div>
            </div>
        </section> --}}
    @endforeach
        {{$posts->links()}}
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
{{--@endsection--}}
</x-slot>
</x-layout>
