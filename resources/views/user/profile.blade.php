@extends('app')

@section('content')
@include('includes/header-short')
<div class="container flex flex-m-col">
    <div class="single-left">
        <div class="card">
            <div class="card-image" style="background-image: url({{ asset($user->image) }});"></div>
            <div class="card-content">
                <title>{{ $user->name }}</title>

                <h2 class="title card-title">
                    <i class="icon-user"></i>{{ $user->name }}<?php switch($user->gender){
                        case 1: echo '<i class="icon-male" title="Пол: мужской"></i>'; break;
                        case 2: echo '<i class="female" title="Пол: женский"></i>'; break;
                    }?>
                </h2>
                <h3 class="subheading"><i class="icon-location"></i>{{ $city->title }}</h3>

                @if($user->bdate != '0000-00-00')
                <p class="date-rus flex">
                    <i class="icon-calendar-empty" title="Возраст"></i>
                    {{ $user->age }}
                    ({{ date('j M Y', strtotime($user->bdate)) }})
                </p>
                @endif

                <p class="flex">
                    <i class="icon-chat"></i>
                    <span>{!! $user->contacts !!}</span>
                </p>

                @if(Auth::user()->admin)
                    <p><i class="icon-phone"></i>{{ $user->tel }}
                    <p><i class="icon-mail-alt"></i>{{ $user->email }}
                @endif
            </div>
        </div>
    </div>

    <div class="single-right">
        @if($adds)
            <div class="card">
                <div class="card-content">
                    <h2 class="title card-title"><i class="icon-flag"></i>Мероприятия</h2>
                    @foreach($adds as $add)
                        <p>
                        <span class="date-rus">{{date('j M h:i', strtotime($add->date_start))}}</span>
                        <a href="{{ url('adds/single/' . $add->id) }}">{{ $add->title }}</a></p>
                    @endforeach
                </div>
            </div>
        @endif

        @if($adds_old)
            <div class="card">
                <div class="card-content">
                    <h2 class="title card-title"><i class="icon-flag-empty"></i>Прошедшие</h2>
                    @foreach($adds_old as $add)
                        <p>
                            <span class="date-rus">{{date('j M Y', strtotime($add->date_start))}}</span>
                            <a href="{{ url('adds/single/' . $add->id) }}">{{ $add->title }}</a></p>
                    @endforeach
                </div>
            </div>
        @endif
    </div>

</div>
@endsection
