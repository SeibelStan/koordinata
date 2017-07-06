@extends('app')

@section('content')
@include('includes/header-adm')
<div class="container">
    <div class="card">
        <div class="card-content">
            <title>Админка</title>
            <h2 class="title card-title">Информация</h2>
            <ul>
                @foreach($info as $unit)
                    <li><a href="{{ url('info/edit-' . $unit->name) }}">{{ $unit->title }}</a>
                @endforeach
            </ul>

            <h2 class="title card-title">Схемы</h2>
            <ul>
                @foreach($staff as $unit)
                    <li><a href="{{ url('staff/edit-' . $unit->name . '?' . $unit->type) }}">{{ $unit->title }}</a>
                @endforeach
            </ul>

            <h2 class="title card-title">
                Новости
                <a href="{{ url('news/add') }}"><i class="icon-plus"></i></a>
            </h2>
            <ul>
                @foreach($news as $unit)
                    <li><a href="{{ url('news/edit-' . $unit->id) }}">{{ $unit->title }}</a>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection
