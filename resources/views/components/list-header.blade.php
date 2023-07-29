@props(['trigger'])
<section class="Pesquisar">
    <div class="search conteiner">
        <div class="col-12 search-box">
            {{-- a action eh blog pra nao bugar quando for um metodo show, ja que nao faz sentido na visao show de post unico --}}
            <form action="/blog" method="GET" name="searchForm" class="search-form">
                @if (request('category'))
                <input type="hidden" name="category" value="{{strip_tags(request('category'))}}"/>
                @endif
                <label>
                    <input type="text" name="searchQuery" placeholder="Pesquisar" value="{{strip_tags(request('searchQuery'))}}"/>
                </label>
                <button>
                    <img src="/search-icon.PNG" alt="Search"
                    style="width: 28px;"/>
                </button>
            </form>
        </div>
    </div>
</section>
<section class="PreLista">
    <!--<div class="tabelaCabecalho">
        #
    </div> -->
    <div class="tabelaCabecalho">
        Nome
    </div>
    <div class="tabelaCabecalho">
        Detalhes
    </div>

    <div class="category-dropdown-wrapper">
        <div>
            {{-- TRIGGER is expected so should be included in prop --}}
            <button class="category-dropdown-btn">
                {{--
                {{isset($currentCategory) ? $currentCategory->name : 'Categorias'}}
                --}}
                <!--Categorias-->
                {{ $trigger }}
                <span class="dropdown-icon">\/</span>
            </button>

            <div class="category-dropdown-options" style="display: none; max-height:200px; overflow:auto;">
                {{--LINKS QUE ESTARAO NO BOTAO  --}}
                {{ $slot }}
            </div>
        </div>
    </div>

</section>
