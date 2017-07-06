@extends('app')

@section('content')
<div class="container">
    <div class="breads">
        <a href="{{ URL::previous() }}">Назад</a>
    </div>

    <div class="adm-banner-images">
    @foreach($files as $file)
        @if($file[0] != '.')
            <div class="adm-banner-wrap">
                <img class="adm-banner-image" src="{{ asset('public/' . $cat . '/' . $file) }}">
                <a href="{{ url('images/remove?cat=' . $cat . '&file=' . $file) }}"><i class="icon add"></i></a>
            </div>
        @endif
    @endforeach
    </div>
</div>
@endsection
