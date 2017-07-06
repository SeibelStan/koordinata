@extends('app')

@section('content')
@include('includes/header-short')
<div class="container flex flex-m-col">
    <div class="single-left">
        <div class="card">
            <div class="card-image" style="background-image: url({{ asset($unit->image) }})"></div>

            <div class="card-content">
                <div class="info-badges">
                    {!! $unit->age > 0 ? '<div class="info-age">' . $unit->age . '+</div>' : '' !!}
                    {!! $unit->gender == 1 ? '<div class="info-gender male">для мужчин</div>' : '' !!}
                    {!! $unit->gender == 2 ? '<div class="info-gender female">для женщин</div>' : '' !!}
                    {!! $unit->ability == 1 ? '<div class="info-ability enabled">без огр. возм.</div>' : '' !!}
                    {!! $unit->ability == 2 ? '<div class="info-ability disabled">для огр. возм.</div>' : '' !!}
                </div>

                <div class="info-badges">
                    <div class="info-meets">Идут: {{ $subscribes }}</div>
                    <div class="info-subscribes">Интересуются: {{ $meets }}</div>
                </div>

                <meta name="keywords" content="{{ $unit->short }}">
                <title>{{ $unit->title }}</title>
                <h2 class="title card-title">{{ $unit->title }}</h2>

                <div class="add-short subheading">{!! preg_replace("/\n/", '<br>', $unit->short) !!}</div>

                <div class="add-info">
                    <div class="info-start">
                        <span class="elapsed" data-time="{{ $unit->date_start_canonic }}"></span>
                        <span class="date-rus">до начала {{ $unit->date_start }}</span>
                    </div>
                    <div class="add-price flex">
                        <span class="info-price">{{ $unit->price > 0 ? $unit->price . ' тг' : 'бесплатно' }}</span>
                        {!! $unit->places > 0 ? '<span class="info-places">, ' . $unit->places . ' мест</span>' : '' !!}
                    </div>
                </div>

                <div class="info-contacts flex">
                    <i class="icon-chat"></i>
                    <span>{!! preg_replace("/\n/", '<br>', $unit->contacts) !!}</span>
                </div>

                <div class="info-address flex">
                    <i class="icon-location"></i>
                    <span>{{ preg_replace("/\n/", '<br>', $unit->address) }}</span>
                </div>

                <div class="card-actions">
                    <button class="btn btn-primary subscribe" data-type="meet" data-id="{{ $unit->id }}">Пойду</button>
                    <button class="btn subscribe" data-type="subscribe" data-id="{{ $unit->id }}">Интересно</button>
                </div>
            </div>
        </div>
    </div>

    <div class="single-right">
        <div class="card">
            <div class="card-content">
                <main class="add-body">{!! $unit->content !!}</main>
                <div class="add-post" title="Размещено">
                    <i class="icon-calendar-empty"></i>{{ date('d.m.Y h:i', strtotime($unit->date)) }}
                    <a href="{{ url('user/' . $unit->user_id) }}"><i class="icon-user"></i>{{ $unit->user_name }}</a>
                </div>
                <div class="card-actions">
                    @if(Auth::check() && (Auth::user()->admin || Auth::user()->id == $unit->user_id))
                        <a href="{{ url('adds/edit/' . $unit->id) }}" class="btn">Редактировать</a>
                    @endif

                    @if(Auth::check() && Auth::user()->admin)
                        <a href="{{ url('adds/remove/' . $unit->id) }}" class="btn">Удалить</a>
                    @endif
                </div>
            </div>
        </div>

        <div class="card add-comments" style="display: none">
            <div class="card-content">
                <h3 class="title card-title"><i class="icon-comment"></i>Комментарии ({{ $comments_count }})</h3>
                @include('includes/comments')
            </div>
        </div>
    </div>
</div>
@endsection
