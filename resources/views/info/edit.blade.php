@extends('app')

@section('content')
@include('includes/header-adm')
<div class="container">
    <div class="card">
        <div class="card-content">
            <title>Редактирование "{{ $unit->title }}"</title>
            <h2 class="title card-title">Редактирование "{{ $unit->title }}"</h2>
            <form action="{{ url('info/save/' . $unit->name) }}" method="post" enctype="multipart/form-data">
                <textarea name="content" cols="30" placeholder="Содержимое" class="ckeditor">{{ $unit->content }}</textarea>
                <button class="btn btn-primary" type="submit">Сохранить</button>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
            </form>
        </div>
    </div>
</div>
@endsection
