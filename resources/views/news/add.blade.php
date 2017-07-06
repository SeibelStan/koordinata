@extends('app')

@section('content')
@include('includes/header-adm')
<div class="container">
    <div class="card">
        <div class="card-content">
            <?php $update = isset($unit) ?>

            @if($update)
                <title>Редактирование новости</title>
                <h2 class="title card-title">Редактирование новости</h2>
            @else
                <title>Добавление новости</title>
                <h2 class="title card-title">Добавление новости</h2>
            @endif

            <form action="{{ url('news/post' . ($update ? '?update=1&id=' . $unit->id  : '')) }}" method="post" enctype="multipart/form-data">
                <input type="text" class="text" name="title" placeholder="Заголовок" value="{{ $update ? $unit->title : '' }}" required>
                <textarea name="content" class="ckeditor">{{ $update ? $unit->content : '' }}</textarea>
                <input type="file" name="image" accept="image/*">
                <button class="btn btn-primary" type="submit">Отправить</button>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
            </form>
        </div>
    </div>
</div>
@endsection
