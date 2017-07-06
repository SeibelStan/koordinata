@extends('app')

@section('content')

    <meta name="keywords" content="{!! implode(', ', explode("\n", $keywords)) !!}">
    <meta name="description" content="{{ $description }}">
    <title>Координата.kz</title>

    <header id="main-header">
        <div class="container">
            <div id="navcont">
                @include('includes/navpanel')
                <div id="searchpanel" class="card">
                    <div class="card-content">
                        <div style="position: relative">
                            <i class="icon-search-1" id="main-search-icon"></i>
                            <input class="text" type="text" id="main-search" placeholder="Поиск" data-dates="">
                        </div>

                        <div id="main-calendar"></div>

                        <div id="searchpanel-cont" class="flex-m-col">
                            <div class="flex-col flex-row">
                                <select id="select-location" class="select">
                                    @foreach($locations as $location)
                                        <option value="{{ $location->id }}" {{ ($selects['location'] == $location->id) || (!$selects && $location->id == -1) ? 'selected' : '' }}>{{ $location->title }}</option>
                                    @endforeach
                                </select>
                                <select id="select-category" class="select">
                                    @foreach($cats as $cat)
                                        <option value="{{ $cat->id }}" {{ ($selects['category'] == $location->id) || (!$selects && $cat->id == -1) ? 'selected' : '' }}>{{ $cat->title }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="flex flex-mx-col">
                                <div class="searchpanel-panel flex">
                                    <div id="filter-location" class="search-row only-one"
                                         style="{{ Auth::check() ? '' : 'display: none;' }}">
                                        <a class="search-filter {{ $filters && $filters['location'] == 1 ? 'active' : '' }}"
                                           data-value="1">Мой город</a>
                                        <a class="search-filter {{ $filters && $filters['location'] == 2 ? 'active' : '' }}"
                                           data-value="2">Вокруг</a>
                                        <a class="search-filter all {{ ($filters && $filters['location'] == 0) || !$filters ? 'active' : '' }}"
                                           data-value="0">Все</a>
                                    </div>
                                    <div id="filter-payment" class="search-row only-one">
                                        <a class="search-filter {{ $filters && $filters['payment'] == 1 ? 'active' : '' }}"
                                           data-value="1">Бесплатные</a>
                                        <a class="search-filter {{ $filters && $filters['payment'] == 2? 'active' : '' }}"
                                           data-value="2">Платные</a>
                                        <a class="search-filter all {{ ($filters && $filters['payment'] == 0) || !$filters ? 'active' : '' }}"
                                           data-value="0">Все</a>
                                    </div>
                                    <div id="filter-age" class="search-row only-one">
                                        <a class="search-filter {{ $filters && $filters['age'] == 16 ? 'active' : '' }}"
                                           data-value="16">16+</a>
                                        <a class="search-filter {{ $filters && $filters['age'] == 18 ? 'active' : '' }}"
                                           data-value="18">18+</a>
                                        <a class="search-filter {{ $filters && $filters['age'] == 30 ? 'active' : '' }}"
                                           data-value="30">30+</a>
                                        <a class="search-filter all {{ ($filters && $filters['age'] == 0) || !$filters ? 'active' : '' }}"
                                           data-value="0">Все</a>
                                    </div>
                                    <div id="filter-gender" class="search-row only-one">
                                        <a class="search-filter {{ $filters && $filters['gender'] == 0 ? 'active' : '' }}"
                                           data-value="0">Для всех</a>
                                        <a class="search-filter {{ $filters && $filters['gender'] == 1 ? 'active' : '' }}"
                                           data-value="1">Мужские</a>
                                        <a class="search-filter {{ $filters && $filters['gender'] == 2 ? 'active' : '' }}"
                                           data-value="2">Женские</a>
                                        <a class="search-filter all {{ ($filters && $filters['gender'] == -1) || !$filters ? 'active' : '' }}"
                                           data-value="-1">Все</a>
                                    </div>
                                    <div id="filter-ability" class="search-row only-one">
                                        <a class="search-filter {{ $filters && $filters['ability'] == 0 ? 'active' : '' }}"
                                           data-value="0">Для всех</a>
                                        <a class="search-filter {{ $filters && $filters['ability'] == 1 ? 'active' : '' }}"
                                           data-value="1">Без огр. возм.</a>
                                        <a class="search-filter {{ $filters && $filters['ability'] == 2 ? 'active' : '' }}"
                                           data-value="2">С огр. возм.</a>
                                        <a class="search-filter all {{ ($filters && $filters['ability'] == -1) || !$filters ? 'active' : '' }}"
                                           data-value="-1">Все</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="userpanel" class="card">
                @if(!Auth::check())
                    <div class="navbar userpanel-bar">
                        <a id="regpanel-toggle" class="navbar-link navbar-tab active"
                           data-toggle="regpanel">Регистрация</a>
                        <a id="logpanel-toggle" class="navbar-link navbar-tab" data-toggle="logpanel"><i class="icon-login"></i>Вход</a>
                    </div>

                    <div class="card-content">
                        <form id="regpanel" class="userpanel-panel panel active" action="{{ asset('auth/register') }}"
                              method="post">
                            <input class="text" type="text" name="name" value="{{ old('name') }}" placeholder="Имя">
                            <input class="text" type="email" name="email" value="{{ old('email') }}"
                                   placeholder="Е-маил">
                            <input class="text" type="password" name="password" placeholder="Пароль">
                            <input class="text" type="password" name="password_confirmation"
                                   placeholder="Ещё раз пароль" style="display: none">

                            <div class="card-actions">
                                <button class="btn btn-primary" type="submit" id="regpanel-enter">Создать профиль</button>
                            </div>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        </form>

                        <form id="logpanel" class="userpanel-panel panel" action="{{ asset('auth/login') }}"
                              method="post">
                            <input class="text" type="email" name="email" value="{{ old('email') }}"
                                   placeholder="Е-маил">
                            <input class="text" type="password" name="password" id="password" placeholder="Пароль">

                            <div class="card-actions">
                                <button class="btn btn-primary" type="submit" id="logpanel-enter">Войти</button>
                                <input type="checkbox" name="remember" title="Запомнить">
                                <a class="btn" href="{{ asset('password/email') }}" id="logpanel-remind"
                                   title="Восстановить пароль">Забыли?</a>
                            </div>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        </form>
                    </div>
                @else
                    <div class="card-content">
                        <div class="flex">
                            <a href="{{ url('user') }}" class="navbar-link">
                                <div class="user-photo userpanel-photo" style="background-image: url({{ asset($user_image) }});"></div>
                            </a>
                            <div class="userpanel-header-right">
                                <a href="{{ url('user') }}" class="navbar-link"><i class="icon-user"></i>{{ Auth::user()->name }}</a>
                                <a href="{{ asset('auth/logout') }}" class="navbar-link"><i class="icon-logout"></i>Выход</a>
                            </div>
                        </div>
                        <a href="{{ url('cabinet') }}" class="navbar-link"><i class="icon-bookmark"></i>Закладки</a>
                        <a href="{{ url('adds/add') }}" class="navbar-link" title="Добавить мероприятие"><i class="icon-plus"></i>Мероприятие</a>
                        @if(Auth::user()->admin)
                            <a href="{{ url('admin') }}" class="navbar-link"><i class="icon-eye-off"></i>Админка</a>
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </header>

    <div class="container">
        <section id="main-adds" class="adds-zone flex-m-col"></section>
    </div>

@endsection
