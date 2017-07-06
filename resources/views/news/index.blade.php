@extends('app')

@section('content')
@include('includes/header-short')
<div class="container">
    <title>Новости</title>

    <h1 class="title container-title">Новости</h1>
    <div class="adds-zone flex-m-col">
        @foreach($units as $unit)
            <div class="card">
                <a href="{{ url('news/single/' . $unit->name) }}">
                    <div class="card-image" style="background-image: url({{ asset($unit->img) }})"></div>
                </a>

                <div class="card-content">
                    <a href="{{ url('news/single/' . $unit->name) }}">
                        <h2 class="title card-title">{{ $unit->title }}</h2>
                    </a>
                    <div class="caption card-caption">
                        {{ str_limit(strip_tags($unit->content), 500) }}
                    </div>
                    <div class="info-start">
                        <div class="date-rus">
                            <i class="icon-calendar-empty"></i>{{ date('j M h:i', strtotime($unit->date)) }}
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
