<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('public/css/cssprep.php?build&min') }}" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('public/img/favicon.png') }}">
</head>
<body id="main-app">

@yield('content')

<div style="display: none">
    <div id="session-message">
        <?php
        if(Session::get('message')) {
            echo Session::get('message');
            Session::forget('message');
        }
        ?>
    </div>
    <div id="base-url">{{ url('/') }}/</div>
    <div id="user-id">{{ Auth::check() ? Auth::user()->id : '' }}</div>
</div>

<script src="{{ asset('//code.jquery.com/jquery-2.1.4.min.js') }}"></script>
<script src="{{ asset('public/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('public/ckeditor/adapters/jquery.js') }}"></script>
<script src="{{ asset('public/js/app.js') }}"></script>
</body>
</html>
