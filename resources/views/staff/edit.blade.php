@extends('app')

@section('content')
@include('includes/header-adm')
<div class="container">
    <div class="card">
        <div class="card-content">
            <p><label><input type="checkbox" id="get-expert">Эксперт</label>

            <div id="staff-expert" style="display: none;">
                <title>Редактирование "{{ $staff->title }}"</title>
                <h2 class="title card-title">Редактирование "{{ $staff->title }}"</h2>

                <form action="{{ url('staff/save/' . $staff->name . '?type=' . $staff->type) }}" method="post"
                      enctype="multipart/form-data">
                    <button class="btn btn-primary" type="submit" id="staff-save">Сохранить</button>
                    <textarea name="content" class="text w100" rows="30" id="staff-content" placeholder="Содержимое">{{ $staff->content }}</textarea>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                </form>
                <a href="http://jsonlint.com/">Валидатор-форматер</a>
            </div>
        </div>
    </div>
</div>
@endsection
