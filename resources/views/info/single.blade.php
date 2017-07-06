@extends('app')

@section('content')
@include('includes/header-short')
<div class="container">
    <div class="card">
        <div class="card-content">
            <meta name="description" content="{{ str_limit(strip_tags($unit->content), 500) }}">
            <title>{{ $unit->title }}</title>
            <h2 class="title card-title">{{ $unit->title }}</h2>
            <div class="card-caption">
                {!! $unit->content !!}
            </div>
        </div>
    </div>
</div>
@endsection
