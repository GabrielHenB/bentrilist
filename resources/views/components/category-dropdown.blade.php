{{-- Isso usa o objeto CategoryDropdown como componente --}}
    <!-- When there is no desire, all things are at peace. - Laozi -->
    <x-list-header>
        <x-slot name="trigger">
             {{-- TODO use current category instead of the button name  --}}
            {{ isset($currCat) ? $currCat->name : "Categorias" }}
        </x-slot>

        <x-dropdown-item href="/blog" :ativo='request()->routeIs("home")'>All</x-dropdown-item>
        @unless(request()->routeIs('aPost'))
        @foreach($categories as $cat)
            <x-dropdown-item
                href="?category={{$cat->slug}}&{{ http_build_query(request()->except('category','page')) }}"
                :ativo='request()->is("/category/{$cat->slug}")'
            >
                {{ucwords($cat->name)}}
            </x-dropdown-item>
        @endforeach
        @endunless
    </x-list-header>
