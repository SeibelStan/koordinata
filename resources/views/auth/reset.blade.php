@extends('app')

@section('content')
<div class="container">
    @if (count($errors) > 0)
        <p></p><strong>Whoops!</strong> There were some problems with your input.
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form method="post" action="{{ url('/password/reset') }}">
        <p><input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Е-маил">
        <p><input type="password" class="form-control" name="password" placeholder="Пароль">
        <p><input type="password" class="form-control" name="password_confirmation" placeholder="Ещё раз пароль">
        <p><button type="submit" class="btn">Сбросить пароль</button>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="token" value="{{ $token }}">
    </form>
</div>
@endsection
