@extends('app')

@section('content')
@include('includes/header-short')
<div class="container flex flex-m-col">
    <div class="single-left">
        <div class="card">
            <div id="change-photo" class="card-image" title="Выбрать фото" style="background-image: url({{ $user_image }});"></div>
            <div class="card-content">
                <title>Профиль</title>
                <form action="{{ url('user/save') }}" method="post" enctype="multipart/form-data">
                    <input id="profile-photo-inp" type="file" name="image" accept="image/*" style="display: none">
                    <input type="text" name="name" class="text" value="{{ Auth::user()->name }}" placeholder="ФИО">
                    <select name="location" class="select">
                        @foreach($locations as $location)
                            <option {{ (Auth::user()->location == $location->id) ? 'selected' : '' }} value="{{ $location->id }}">{{ $location->title }}</option>
                        @endforeach
                    </select>
                    <select name="gender" class="select">
                        <option {{ (Auth::user()->gender == 0) ? 'selected' : '' }} value="0">Пол не указан</option>
                        <option {{ (Auth::user()->gender == 1) ? 'selected' : '' }} value="1">Мужской</option>
                        <option {{ (Auth::user()->gender == 2) ? 'selected' : '' }} value="2">Женский</option>
                    </select>
                    <p><label>Дата рождения</label></p>
                    <input class="text" type="date" name="bdate" value="{{ Auth::user()->bdate }}">
                    <textarea name="contacts" class="text" placeholder="Контакты" maxlength="500">{{ Auth::user()->contacts }}</textarea>
                    <input type="text" name="tel" class="text" value="{{ Auth::user()->tel }}" placeholder="Телефон в виде 76665554444" pattern="\d{11}">
                    <input type="password" name="pass1" class="text" placeholder="Пароль">
                    <input type="password" name="pass2" class="text" placeholder="Ещё пароль">
                    <button class="btn btn-primary" type="submit">Сохранить</button>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                </form>
            </div>
        </div>
    </div>

    <div class="single-right">
        @if($adds)
        <h1 class="title container-title mb16"><i class="icon-flag"></i>Мероприятия</h1>
        @foreach($adds as $unit)
            <div class="card">
                <div class="card-content">
                    <h2 class="title card-title">
                        <a href="{{ url('adds/single/' . $unit->id) }}">{{ $unit->title }}</a>
                    </h2>
                    <div class="date-rus mb8">
                        <i class="icon-calendar-empty"></i>{{date('j M h:i', strtotime($unit->date_start))}}
                    </div>
                    <div class="flex">
                        <div  class="subscribers-cont">
                            <h3 class="subheading" style="display: none">Идут</h3>
                            <div class="subscribers" data-type="meet" data-id="{{ $unit->id }}"></div>
                        </div>
                        <div  class="subscribers-cont">
                            <h3 class="subheading" style="display: none">Интересуются</h3>
                            <div class="subscribers" data-type="subscribe" data-id="{{ $unit->id }}"></div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        @endif

        @if($adds_old)
        <h1 class="title container-title mb16"><i class="icon-flag-empty"></i>Прошедшие</h1>
        @foreach($adds_old as $unit)
            <div class="card">
                <div class="card-content">
                    <h2 class="title card-title">
                        <a href="{{ url('adds/single/' . $unit->id) }}">{{ $unit->title }}</a>
                    </h2>
                    <div class="date-rus mb8">
                        <i class="icon-calendar-empty"></i>{{date('j M h:i', strtotime($unit->date_start))}}
                    </div>
                    <div class="flex">
                        <div  class="subscribers-cont">
                            <h3 class="subheading">Идут</h3>
                            <div class="subscribers" data-type="meet" data-id="{{ $unit->id }}"></div>
                        </div>
                        <div  class="subscribers-cont">
                            <h3 class="subheading">Интересуются</h3>
                            <div class="subscribers" data-type="subscribe" data-id="{{ $unit->id }}"></div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        @endif
    </div>
</div>
@endsection
