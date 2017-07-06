@extends('app')

@section('content')
@include('includes/header-short')
<div class="container">

<?php $update = isset($unit) ?>

<form class="flex flex-m-col" action="{{ url('adds/post' . ($update ? '?update=1&id=' . $unit->id  : '')) }}" method="post" enctype="multipart/form-data">
    <div class="single-left">
        <div class="card">
            <div class="card-content">
                @if($update)
                    <title>Редактирование мероприятия</title>
                    <h2 class="title card-title"><i class="icon-pencil-1"></i>Мероприятие</h2>
                @else
                    <title>Добавление мероприятия</title>
                    <h2 class="title card-title"><i class="icon-plus"></i>Мероприятие</h2>
                @endif

                    <div class="flex flex-row">
                        <select name="location" class="select">
                            @foreach($locations as $location)
                                <option value="{{ $location->id }}" {{ $update && ($unit->location == $location->id) ? 'selected' : '' }}>{{ $location->title }}</option>
                            @endforeach
                        </select>
                        <select name="category" class="select">
                            @foreach($cats as $cat)
                                <option value="{{ $cat->id }}" {{ $update && ($unit->category == $cat->id) ? 'selected' : '' }}>{{ $cat->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <input type="text" class="text" name="title" placeholder="Название" value="{{ $update ? $unit->title : '' }}" required>
                    <input type="text" class="text" name="age" placeholder="Возраст от" value="{{ $update ? $unit->age : '' }}" pattern="\d*">
                    <div class="flex flex-row">
                        <input type="text" class="text" name="price" placeholder="Цена" value="{{ $update ? $unit->price : '' }}" required pattern="\d+">
                        <input type="text" class="text" name="places" placeholder="Мест" value="{{ $update ? $unit->places : '' }}" required pattern="\d+">
                    </div>
                    <input type="datetime-local" class="text" name="date_start" placeholder="Начало в формате 2016-01-01 00:00" value="{{ $update ? $unit->date_start : '' }}" required pattern="\d{4}-\d\d-\d\d \d\d:\d\d">
                    <input type="text" class="text" name="contacts" placeholder="Контакты" value="{{ $update ? $unit->contacts : '' }}" required>
                    <input type="text" class="text" name="address" placeholder="Адрес" value="{{ $update ? $unit->address : '' }}" required maxlength="300">

                    <div class="select-cont">
                        <div class="form-row">
                            <label><input type="radio" name="gender" value="0" {{ !$update || $unit->gender == 0 ? 'checked' : '' }}><span>Для всех</span></label>
                            <label><input type="radio" name="gender" value="1" {{ $update && $unit->gender == 1 ? 'checked' : '' }}><span>Мужское</span></label>
                            <label><input type="radio" name="gender" value="2" {{ $update && $unit->gender == 2 ? 'checked' : '' }}><span>Женское</span></label>
                        </div>
                        <div class="form-row">
                            <label><input type="radio" name="ability" value="0" {{ !$update || $unit->ability == 0 ? 'checked' : '' }}><span>Для всех</span></label>
                            <label><input type="radio" name="ability" value="1" {{ $update && $unit->ability == 1 ? 'checked' : '' }}><span>Без огр. возм.</span></label>
                            <label><input type="radio" name="ability" value="2" {{ $update && $unit->ability == 2 ? 'checked' : '' }}><span>Для огр. возм.</span></label>
                        </div>
                    </div>
            </div>
        </div>
    </div>

    <div class="single-right">
        <div class="card">
            <div class="card-content">
                <textarea name="short" placeholder="Краткое описание (до 300 символов)" rows="5" class="text" maxlength="300" required style="width: 100%">{{ $update ? $unit->short : '' }}</textarea>
                <textarea name="content" placeholder="Описание" class="ckeditor">{{ $update ? $unit->content : '' }}</textarea>
                <p><label>Обложка мероприятия</label></p>
                <input type="file" name="image" accept="image/*">
                <button class="btn btn-primary" type="submit">{{ $update ? 'Сохранить' : 'Добавить'}}</button>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
            </div>
        </div>
    </div>
</form>
</div>
@endsection
