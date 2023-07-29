{{--@extends('layout')--}}
{{--@section('content')--}}
<x-layout title="Laraferst | Register">
    @section('title-2')
        <h1 id="suaLista">Crie a sua Conta!</h1>
    @endsection
    <x-slot name="content">
    <section class="register-section conteiner">
        <div class="form-wrapper row">
            <form class="register form col-12" method="POST" action="/register">
                {{-- isso aloca um csrf token --}}
                @csrf
                <div class="register form-item mb-3">
                    <label class="register form-label" for="username">
                        Username
                    </label>
                    <input class="register form-control" type="text" name="username" value="{{old('username')}}" required/>
                    @error('username')
                    <p class="text-red-500 text-xs mt-1" style="color: red; font-size: x-small;">{{$message}}</p>
                    @enderror
                </div>
                <div class="register form-item mb-3">
                    <label class="register form-label" for="name">
                        Nome
                    </label>
                    <input class="register form-control" type="text" name="name" value="{{old('name')}}" required/>
                    {{-- O $message eh provido pelo error em si --}}
                    @error('name')
                        <p class="text-red-500 text-xs mt-1" style="color: red; font-size: x-small;">{{$message}}</p>
                    @enderror
                </div>
                <div class="register form-item mb-3">
                    <label class="register form-label" for="email">
                        E-mail
                    </label>
                    <input class="register form-control" type="email" name="email" value="{{old('email')}}" required/>
                    @error('email')
                    <p class="text-red-500 text-xs mt-1" style="color: red; font-size: x-small;">{{$message}}</p>
                    @enderror
                </div>
                <div class="register form-item mb-3">
                    <label class="register form-label" for="password">
                        Senha
                    </label>
                    <input class="register form-control" type="password" name="password" required/>
                    @error('password')
                    <p class="text-red-500 text-xs mt-1" style="color: red; font-size: x-small;">{{$message}}</p>
                    @enderror
                </div>

                <div class="register form-item mb-3">
                    <button type="submit" class="btn btn-primary">Registrar</button>
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




