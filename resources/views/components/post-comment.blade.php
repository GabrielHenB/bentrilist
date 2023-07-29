@props(['comment'])
<article class="comment-wrapper row">
    <div class="comment-header col-4">
        <img src="/avatar.png" alt="avatar" />
        <strong class="comment-username text-sm-center">{{$comment->author->username}}</strong>
        <p class="comment-datetime text-sm-center make-small">
            <time>
                <!--Published 8 years ago.-->
                {{($comment->created_at->format("F j, Y, g:i a"))}}
            </time>
        </p>
    </div>
    <div class="comment-content col-8">
        {{$comment->body}}
    </div>
</article>
