{{--@extends('layout')--}}
{{--@section('content')--}}
<x-layout title="Laraferst | Login">
    @section('title-2')
        <h1 id="suaLista">Entre na sua Conta!</h1>
    @endsection
    <x-slot name="content">
        <section class="register-section conteiner">
            <div class="form-wrapper row">
                <form class="register form col-12" method="POST" action="/login">
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
                        <label for="forgot" style="font-size: x-small;">Esqueceu sua senha? </label>
                        <input type="checkbox" name="forgot" class="form-forgot" />
                        <button type="submit" class="btn btn-primary">Entrar</button>
                    </div>
                </form>

                <h2>Não tem uma conta? <a href="/register">Cadastre-se</a></h2>

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





