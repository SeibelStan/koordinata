@extends('app')

@section('content')
@include('includes/header-short')
<div class="container">
    <div class="card">
        <div class="card-content">
            <meta name="description" content="{{ str_limit(strip_tags($unit->content), 500) }}">

            @if(file_exists('public/data/news-img/' . $unit->id))
                <img class="card-image new-image" src="{{ asset('public/data/news-img/' . $unit->id) }}">
            @endif

            <title>{{ $unit->title }}</title>
            <h2 class="title card-title">{{ $unit->title }}</h2>
            <main class="news-body">{!! $unit->content !!}</main>

            <div class="add-post" title="Размещено">
                <i class="icon-calendar-empty"></i>{{ date('d.m.Y h:i', strtotime($unit->date)) }}
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-content">
            <h3 class="title card-title"><i class="icon-comment"></i>Комментарии ({{ $comments_count }})</h3>
            @include('includes/comments')
        </div>
    </div>
</div>
@endsection
