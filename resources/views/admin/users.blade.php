@extends('app')

@section('content')
@include('includes/header-adm')
<div class="container">
    <div class="card">
        <div class="card-content">
            <title>Пользователи</title>
            <h2 class="title card-title">Пользователи</h2>
            <table class="table">
                <tr>
                    <th>Имя
                    <th>Емейл
                    <th>Создан
                    <th>Удалить
                </tr>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->name }}
                        <td><a class="email-insert">{{ $user->email }}</a>
                        <td>{{ $user->created_at }}
                        <td>
                            <a href="{{ url('user/login?uid=' . $user->id) }}" title="Войти за">В</a>
                            <a href="{{ url('admin/users/remove?uid=' . $user->id) }}" onclick="if(!confirm('Удалить пользователя?')) return false">П</a>
                            <a href="{{ url('admin/users/purge?uid=' . $user->id) }}" onclick="if(!confirm('Удалить пользователя и все его данные?')) return false">ПиД</a>
                    </tr>
                @endforeach
            </table>

            <h2 class="title card-title">Рассылка писем</h2>
            <form action="{{ url('admin/users/email') }}" method="post" enctype="multipart/form-data">
                <input type="text" class="text email-target" name="emails" placeholder="Адреса через пробел. Пустое - отправить всем." style="width: 100%">
                <input type="text" class="text" name="title" placeholder="Заголовок" style="width: 100%">
                <textarea name="content" class="ckeditor"></textarea>
                <button class="btn btn-primary" type="submit">Послать</button>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
            </form>
        </div>
    </div>
</div>
@endsection
