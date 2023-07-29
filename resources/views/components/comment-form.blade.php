
<div class="conteiner comment-form-conteiner">
    <form class="comment-form" method="POST" action="/posts/{{$post->slug}}/comment">
        @csrf
        <header class="row comment-form-header">
            <div class="col-4">
                <img src="https://i.pravatar.cc/60" alt="avatar" class="comment-form-user-thumb"/>
            </div>
            <div class="col-4">
                <h2 class="comment-form-title">Olá, <strong class="comment-form-user-name">
                        {{ auth()->user()->name }}
                    </strong>
                </h2>
            </div>
            <div class="col-4">
                <label for="commentFormTextarea">Quer enviar sua avaliação?</label>
            </div>
        </header>
        <div class="row comment-form-content">
            <div class="col-12">
                <textarea name="commentFormTextarea" rows="5" class="comment-form-content-text" placeholder="Digite sua avaliação aqui" required></textarea>
            </div>
        </div>
        <div class="row comment-button-row"><button class="col-12 btn-secondary comment-button">Postar</button></div>
        <div class="row comment-form-errors">
            @error('commentFormTextarea')
            <div class="col-12 comment-form-error">
                <p style="background-color: black; color: red; padding: 2px; margin: 2px;">
                    Error:
                    {{$message}}
                </p>
            </div>
            @enderror
        </div>
    </form>
</div>
