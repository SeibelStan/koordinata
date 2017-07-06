<div id="navpanel" class="card">
    @if(!preg_match('/\/$/', $_SERVER['REQUEST_URI']))
        <a href="{{ url('/') }}" class="navbar-link" title="Мероприятия"><i class="icon-home"></i></a>
    @endif
    <a href="{{ url('news') }}" class="navbar-link"><i class="icon-newspaper"></i>Новости</a>
    <a href="{{ url('info/about') }}" class="navbar-link"><i class="icon-info-circled"></i>О проекте</a>

    @if(Auth::check() && !preg_match('/\/$/', $_SERVER['REQUEST_URI']))
        <div class="right">
            @if(Auth::user()->admin)
                <a href="{{ url('admin') }}" class="navbar-link" title="Админка"><i class="icon-eye-off"></i></a>
            @endif
            <a href="{{ url('user') }}" class="navbar-link" title="Профиль"><i class="icon-user"></i></a>
            <a href="{{ url('cabinet') }}" class="navbar-link" title="Закладки"><i class="icon-bookmark"></i></a>
            <a href="{{ url('adds/add') }}" class="navbar-link" title="Добавить мероприятие"><i class="icon-plus"></i></a>
            <a href="{{ asset('auth/logout') }}" class="navbar-link" title="Выйти"><i class="icon-logout"></i></a>
        </div>
    @endif
</div>