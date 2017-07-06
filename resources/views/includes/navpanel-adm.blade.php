<div id="navpanel" class="card">
    @if(!preg_match('/\/$/', $_SERVER['REQUEST_URI']))
        <a href="{{ url('/') }}" class="navbar-link"><i class="icon-home"></i>Главная</a>
    @endif
    @if(!preg_match('/admin$/', $_SERVER['REQUEST_URI']))
        <a href="{{ url('admin') }}" class="navbar-link">Админка</a>
    @endif
    <a href="{{ url('admin/tasks') }}" class="navbar-link">Запросы</a>
    <a href="{{ url('admin/users') }}" class="navbar-link">Пользователи</a>

    @if(Auth::check())
        <div class="right">
            <a href="{{ asset('auth/logout') }}" class="navbar-link"><i class="icon-logout"></i>Выход</a>
        </div>
    @endif
</div>