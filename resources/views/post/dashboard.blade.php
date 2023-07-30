{{--@extends('layout')--}}
<x-layout :title="$title">
    {{--@section('content')--}}
    @section('title-2')
        <h1 id="suaLista">Dashboard</h1>
    @endsection
    <x-slot name="content">
        {{-- <x-category-dropdown /> --}}
        <p style="color:darkred">Atenção: O botão deletar não pede confirmação, tenha certeza do que está fazendo!!</p>
        @if($posts->count())
            <table>
                <thead>
                <tr>
                    <th>Titulo</th>
                    <th>Resumo</th>
                    <th colspan="2">Options</th>
                </tr>
                </thead>
                <tbody>
                @foreach($posts as $item)
                    <tr>
                        <td>
                            <strong><a class="table-item-title" href="/posts/{{$item->slug}}">{{$item->title}}</a></strong>
                            <a class="table-author" href="?author={{$item->author->username}}">{{$item->author->name}}</a>
                        </td>
                        <td>{{$item->excerpt}}</td>
                        <td><a class="table-option" href="/adm/posts/edit/{{$item->slug}}">Editar</a></td>
                        <td>
                            <form method="POST" action="/adm/posts/delete/{{$item->id}}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="table-option" style="color:darkred">Deletar</button>
                            </form>
                        </td>
                    </tr>

                @endforeach
                </tbody>
            </table>
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
