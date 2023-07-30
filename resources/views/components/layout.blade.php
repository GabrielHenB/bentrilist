<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <meta charset="UTF-8">
    <meta name="author" content="BentriCode WebTeam">
    <meta name="description" content="Ordene e crie sua lista dos capitulos">
    <title>{{ $title }}</title>
    <link rel="stylesheet" href="/estilos.css">
    <link rel="icon" href="/bentricon.ico">
    <script>
        // FUNCOES BASICAS
        function O(i){
            //Substitui o getElementById por O.
            //return document.getElementById(i);
            return typeof i == 'object' ? i : document.getElementById(i);
        }
        function S(i){
            //Util para selecionar o CSS interno dos elementos.
            return O(i).style;
        }
        function C(i){
            //Retorna array de elementos com o nome da classe passada para a funçao.
            return document.getElementsByClassName(i);
        }
        // FUNCOES DA PAGINA EM GERAL


        // VARIAVEIS GLOBAIS

        let isDark = false;

        // WINDOW

        window.onload = () => {
            //Botao Noturno
            O('bLuz').onclick = () => {
                if(isDark){
                    S('mainMain').backgroundColor = '#FFFFFF';
                    S('suaLista').color = '#000000';
                    S('sobreNos').color = '#000000';
                    isDark = false;
                }
                else{
                    S('mainMain').backgroundColor = '#161616';
                    S('suaLista').color = '#FFFFFF';
                    S('sobreNos').color = '#FFFFFF';
                    isDark = true;
                }
            };
            //Botao Donate:
            O('bDonate').onclick = () => {
                document.getElementsByClassName('boxLista')[0].innerHTML = `
        <section style="background-color: #101010; color: white; margin: 10px; padding: 5px; border-radius: 6px;">
            <p> No momento não aceitamos doações, mas não é necessário pagar para utilizar a página!</p>
            Doe aqui: <a style="text-decoration: none; color: rgb(255,100,255);" href="#">DOAR</a>
        </section>
        `;
            };

            /* EVENTOS DO BOTAO DE DROPDOWN */
            const buttons = document.querySelectorAll('.category-dropdown-btn');
            const options = document.querySelectorAll('.category-dropdown-options');

            buttons.forEach(button => {
                button.onclick = () => {
                    options.forEach(option => {
                        option.style.display = (option.style.display == 'block') ? 'none' : 'block';
                    });
                };

            });



        };
    </script>
    <!-- Alpine JS -->
    <!-- usado para eventos de dropdown -->
    <script src="//unpkg.com/alpinejs" defer></script>
</head>
<body>
<header>
    <div class="logo">
        <img src="/logo.png" alt="Logotipo">
    </div>
    <nav>
        <a href="/home">Home</a>
        <a id="bLista" href="/all">Todos</a>
        <a id="bPosts" href="/blog">Lista</a>
        {{-- @guest --}}
        @if(!auth()->check())
            <a id="bLogar" href="/login">Entrar</a>
            <a id="bLogar" href="/register">Cadastrar</a>
        @else
            <!--<a id="bLogar" href="/adm/posts/create">Adm</a>-->
            <x-generic-dropdown btnId="admMenu">
                <x-slot name="trigger">
                    Adm
                </x-slot>
                <x-dropdown-item :ativo="request()->is('/adm/dashboard')" href="/adm/dashboard">Dashboard</x-dropdown-item>
                <x-dropdown-item :ativo="request()->is('/adm/posts/create')" href="/adm/posts/create">Create</x-dropdown-item>
            </x-generic-dropdown>
            <a id="bLogar" href="/logout">Sair ({{auth()->user()->name}})</a>
        @endif
        <a id="aboutUs" href="#sobreNos">Sobre nos</a>
        <a id="bDonate" href="#">Doar</a>
        <a style='color: black' id="bLuz">DARK-MODE</a>
    </nav>
</header>

{{-- Isso joga a mensagem flash na tela --}}
<!-- Inicio flash -->
<x-flash />
<!-- Fim flash -->
<!-- Botao Lateral em Construcao -->
<nav class="corner-nav">
    <ul class="corner-button">
        <li><a href="#suaLista">Top</a></li>
    </ul>
</nav>
<!-- Corpo principal do documento -->
<main id="mainMain">
    <div class="boxLista">
        {{-- Isso trocado em outros sublayouts quando usamos o @show no final --}}
        @section('title-2')
            <h1 id="suaLista">Sua Lista</h1>
        @show
        {{-- //used instead of yields('content') --}}
        {{ $content }}
    </div>
    <div id="sobreNos" class="sobre">
        <div class="texto-contato">
            <h1>Sobre nós</h1>
            <p>A Bentrilist é uma empresa ficticia no momento, fundada no inicio da faculdade pelos primeiros e unicos
                membros Márlon e Gabriel, usando seu nome para treino prático. </p>
        </div>
        <div class="contato">
            <div class="editorial">
                <h1>Editorial</h1>
                <div class="editor">
                    <img src="/avatar.png" alt="">
                    <p><b>Editor:</b> Márlon</p>
                </div>
                <div class="editor">
                    <img src="/avatar.png" alt="">
                    <p><b>Editor:</b> Gabriel</p>
                </div>
                <div class="editor">
                    <img src="/avatar.png" alt="">
                    <p><b>Gerente Geral:</b> Bentrielo</p>
                </div>
            </div>
            <div class="rede-social">
                <h1>Redes sociais</h1>
                <a href="https://www.facebook.com/"><img src="/icone-facebook.png" alt="Facebook"></a>
                <a href="https://www.instagram.com/"><img src="/icone-instagram.png" alt="Instagram"></a>
                <a href="https://www.twitter.com/"><img src="/icone-twitter.png" alt="Twitter"></a>
            </div>

        </div>
    </div>
</main>

<!-- Bootstrap scripts --->
<!-- --->
</body>
<footer>
    <img src="/logofooter.png" alt="Logotipo">
    <p>Autores: Equipe da Bentrilist Ficticia</p>
    <p>©Copyright 2021-2023: Todos direitos reservados para Bentrilist</p>
    <a href="/terms">Termos de Uso</a>
</footer>
</html>


