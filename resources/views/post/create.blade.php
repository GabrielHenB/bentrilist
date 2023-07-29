{{--@extends('layout')--}}
{{--@section('content')--}}
<x-layout title="Laraferst | Create">
    @section('title-2')
        <h1 id="suaLista">Admin > Create</h1>
    @endsection
    <x-slot name="content">
        <section class="register-section conteiner">
            <div class="form-wrapper row">
                <form class="register form col-12" method="POST" action="/adm/posts/create" enctype="multipart/form-data">
                    {{-- isso aloca um csrf token --}}
                    @csrf
                    <div class="register form-item mb-3">
                        <label class="register form-label" for="title">
                            Titulo
                        </label>
                        <input class="register form-control" type="text" name="title" value="{{old('title')}}" required/>
                        @error('title')
                        <p class="text-red-500 text-xs mt-1" style="color: red; font-size: x-small;">{{$message}}</p>
                        @enderror
                        @error('slug')
                        <p class="text-red-500 text-xs mt-1" style="color: red; font-size: x-small;">
                            O titulo já existe e resultou em:
                            {{$message}}
                        </p>
                        @enderror
                    </div>
                    <div class="register form-item mb-3">
                        <label class="register form-label" for="excerpt">
                            Sobre
                        </label>
                        <textarea class="register form-control" type="text" name="excerpt" required></textarea>
                        {{-- O $message eh provido pelo error em si --}}
                        @error('excerpt')
                        <p class="text-red-500 text-xs mt-1" style="color: red; font-size: x-small;">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="register form-item mb-3">
                        <label class="register form-label" for="body">
                            Enredo
                        </label>
                        <textarea class="register form-control" rows='3' type="email" name="body" value="" required></textarea>
                        @error('body')
                        <p class="text-red-500 text-xs mt-1" style="color: red; font-size: x-small;">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="register form-item mb-3">
                        <label class="register form-label" for="thumbnail">
                            Thumb
                        </label>
                        <input class="register form-control" type="file" name="thumbnail" />
                        @error('thumbnail')
                        <p class="text-red-500 text-xs mt-1" style="color: red; font-size: x-small;">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="register form-item mb-3">
                        <label class="register form-label" for="category_id">

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
                        <button type="submit" class="btn btn-primary">Postar</button>
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




