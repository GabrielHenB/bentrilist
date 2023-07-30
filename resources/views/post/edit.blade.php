{{--@extends('layout')--}}
{{--@section('content')--}}
<x-layout title="Bentrilist | Edit">
    @section('title-2')
        <h1 id="suaLista">Admin > Edit</h1>
    @endsection
    <x-slot name="content">
        <section class="register-section conteiner">
            <div class="form-wrapper row">
                <form class="register form col-12" method="POST" action="/adm/posts/edit/{{$post->id}}" enctype="multipart/form-data">
                    {{-- isso aloca um csrf token --}}
                    @csrf
                    {{-- isso indica que estamos fazendo um patch e nao post --}}
                    @method('PATCH')

                    <x-form.input-comp name="title" :value="$post->title" />

                    <x-form.input-comp name="slug" :value="$post->slug" />

                    <div class="register form-item mb-3">
                        @error('slug')
                        <p class="text-red-500 text-xs mt-1" style="color: red; font-size: x-small;">
                            Tentou alterar outro post se nao o indicado, erro:
                            {{$message}}
                        </p>
                        @enderror
                    </div>

                    <x-form.text-input-comp name="excerpt" style="height:140px;">{{$post->excerpt}}</x-form.text-input-comp>

                    <x-form.text-input-comp name="body" style="height:200px;">{{$post->body}}</x-form.text-input-comp>

                    <x-form.input-comp name="thumbnail" type="file" />

                    <div class="register form-item mb-3">
                        <label class="register form-label" for="category_id">
                            Categoria
                        </label>
                        <select class="register form-control" name="category_id" required>
                            @foreach($cats as $cat)
                                <option value="{{$cat->id}}">{{ucwords($cat->name)}}</option>
                            @endforeach
                        </select>
                        @error('category')
                        <p class="text-red-500 text-xs mt-1" style="color: red; font-size: x-small;">{{$message}}</p>
                        @enderror
                    </div>

                    <div class="register form-item mb-3">
                        <button type="submit" class="btn btn-primary">Editar</button>
                    </div>
                </form>

                @if($errors->any())
                    @foreach($errors->all() as $err)
                        <ul style="margin-right: 14px; text-align: right; font-size: x-small; color: red; list-style: none;">
                            <li>
                                <p style="font-size: x-small;">{{$err}}</p>
                            </li>
                        </ul>
                    @endforeach
                @endif
            </div>
        </section>
    </x-slot>
</x-layout>
