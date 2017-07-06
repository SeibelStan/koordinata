@if(Auth::check())
    <form id="comment-form" action="{{ url('comment/' . $type . '/post') }}" method="post">
        <textarea name="content" class="text" cols="50" rows="5" placeholder="Сообщение"></textarea>
        <input type="hidden" name="post_id" value="{{ $unit->id }}">
        <input type="hidden" name="reply_id" id="reply_id" value="">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <button class="btn btn-primary" type="submit">Отправить</button>
    </form>
@else
    <p><a class="get-login">Войдите</a> или <a class="get-reg">зарегистрируйтесь</a>, что бы оставлять комментарии.
@endif

@foreach($comments as $comment)
    <div class="comment-unit">
        <div class="comment-root" id="comment-{{ $comment->id }}" data-id="{{ $comment->id }}">
            <a href="{{ url('user/' . $comment->user_id) }}">
                <div class="user-photo comment-photo" style="background-image: url({{ asset($comment->image) }});"></div>
            </a>
            <div class="comment-right">
                @if(Auth::check())
                    <a href="#comment-{{ $comment->id }}" title="Ответить на комментарий" class="comment-go-reply"><strong>{{ $comment->user_name }}</strong></a>:
                    @if(Auth::user()->admin)
                        <a title="Удалить комментарий" class="comment-go-remove">x</a>
                    @endif
                @else
                    <strong>{{ $comment->user_name }}</strong>
                @endif
                <a href="#comment-{{ $comment->id }}" title="Ссылка на комментарий">#</a>
                <div class="comment-text">{{ $comment->content }}</div>
            </div>
        </div>

        @foreach($comment->replies as $comment)
            <div class="comment-reply" id="comment-{{ $comment->id }}" data-id="{{ $comment->id }}">
                <a href="{{ url('user/' . $comment->user_id) }}">
                    <div class="user-photo comment-photo" style="background-image: url({{ asset($comment->image) }});"></div>
                </a>
                <div class="comment-right">
                    <strong>{{ $comment->user_name }}</strong>
                    <a href="#comment-{{ $comment->id }}" title="Ссылка на комментарий">#</a>
                    @if(Auth::check() && Auth::user()->admin)
                        <a title="Удалить комментарий" class="comment-go-remove">x</a>
                    @endif
                    <div class="comment-text">{{ $comment->content }}</div>
                </div>
            </div>
        @endforeach
    </div>
@endforeach