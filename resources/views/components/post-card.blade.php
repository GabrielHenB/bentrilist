@props(['post'])
        <div {{ $attributes->merge(["class"=>"conteiner"])}}>
        @if (!empty($post))
            <section class="Lista">
                <div class="BoxPost row">
                    <div class="PostTitulo">
                        <a style="text-decoration: none; color:inherit;" href="posts/{{$post->slug}}">
                            <img style="display:block" src="{{($post->thumbnail ? asset('storage/'.$post->thumbnail) : '/manga2.jpg')}}" alt="post-thumb"/>
                            {{$post->title}}
                        </a>
                        {{--<h2 class="MangaTitulo">{{$post->title}}</h2>--}}
                    </div>
                    <div class="PostDetalhes">
                        <p class="PostDetalhesBody">
                            {{$post->body}}
                        </p>
                    </div>
                    <div class="PostDetalhes">
                        <p class="PostDetalhesItem">
                            {{-- be careful with N+1 here --}}
                            <a href="?category={{$post->category->slug}}">{{$post->category->name}}</a>
                        </p>
                        <p class="PostDetalhesItem">
                            <span class="small-text">Added By:</span>
                            <a href="?author={{$post->author->username}}">{{$post->author->name}}</a>
                            <br><span class="small-text">Published In:</span> {{$post->created_at->diffForHumans()}}
                        </p>
                    </div>
                </div>
            </section>
        @endif
        </div>
