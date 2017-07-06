@extends('app')

@section('content')
<div class="container">
    @if (session('status'))
        <p><strong>{{ session('status') }}</strong>
    @endif

    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <p><strong>Whoops!</strong> There were some problems with your input.
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="post" action="{{ url('/password/email') }}">
        <p><input type="text" name="email" value="{{ old('email') }}" placeholder="Е-маил">
        <p><button type="submit" class="btn">Отправить ссылку</button>
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
    </form>
</div>
@endsection
