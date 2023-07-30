{{--@extends('layout')--}}
{{--@section('content')--}}
<x-layout title="Bentrilist | Create">
    @section('title-2')
        <h1 id="suaLista">Admin > Create</h1>
    @endsection
    <x-slot name="content">
        <section class="register-section conteiner">
            <div class="form-wrapper row">
                <form class="register form col-12" method="POST" action="/adm/posts/create" enctype="multipart/form-data">
                    {{-- isso aloca um csrf token --}}
                    @csrf
                    <x-form.input-comp name="title" />

                    <div class="register form-item mb-3">
                        @error('slug')
                        <p class="text-red-500 text-xs mt-1" style="color: red; font-size: x-small;">
                            O titulo já existe e resultou em:
                            {{$message}}
                        </p>
                        @enderror
                    </div>

                    <x-form.text-input-comp name="excerpt" />

                    <x-form.text-input-comp name="body" />

                    <x-form.input-comp name="thumbnail" type="file" />

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




