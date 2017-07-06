@extends('app')

@section('content')
@include('includes/header-short')
<div class="container">
    <title>Закладки</title>

    @if(!($meets || $meets_old || $subscribes || $subscribes_old))
        <div class="card">
            <div class="card-content">
                <h2 class="title card-title">Здесь пока ничего нет</h2>
                <div class="caption card-caption">
                    Поищите <a href="{{ url('/') }}">мероприятия</a>
                </div>
            </div>
        </div>
    @endif

    @if($meets)
        <h1 class="title container-title"><i class="icon-flag"></i>Пойду</h1>
        <div class="adds-zone flex-m-col">
            @foreach($meets as $unit)
                <div class="card">
                    <a href="{{ url('adds/single/' . $unit->id) }}">
                        <div class="card-image" style="background-image: url({{ asset($unit->image) }})"></div>
                    </a>

                    <div class="card-content">
                        <h2 class="title card-title">
                            <a href="{{ url('adds/single/' . $unit->id) }}">{{ $unit->title }}</a>
                        </h2>

                        <div class="card-actions">
                            <button class="btn btn-primary subscribe" data-type="meet" data-id="{{ $unit->id }}">
                                Пойду
                            </button>
                            <button class="btn subscribe" data-type="subscribe" data-id="{{ $unit->id }}">
                                Интересно
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    @if($subscribes)
        <h1 class="title container-title"><i class="icon-heart"></i>Интересно</h1>
        <div class="adds-zone flex-m-col">
            @foreach($subscribes as $unit)
                <div class="card">
                    <a href="{{ url('adds/single/' . $unit->id) }}">
                        <div class="card-image" style="background-image: url({{ asset($unit->image) }})"></div>
                    </a>

                    <div class="card-content">
                        <h2 class="title card-title">
                            <a href="{{ url('adds/single/' . $unit->id) }}">{{ $unit->title }}</a>
                        </h2>

                        <div class="card-actions">
                            <button class="btn btn-primary subscribe" data-type="meet" data-id="{{ $unit->id }}">
                                Пойду
                            </button>
                            <button class="btn subscribe" data-type="subscribe" data-id="{{ $unit->id }}">
                                Интересно
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    @if($meets_old)
        <h1 class="title container-title"><i class="icon-flag-empty"></i>Архив походов</h1>
        <div class="adds-zone flex-m-col">
            @foreach($meets_old as $unit)
                <div class="card">
                    <a href="{{ url('adds/single/' . $unit->id) }}">
                        <div class="card-image" style="background-image: url({{ asset($unit->image) }})"></div>
                    </a>

                    <div class="card-content">
                        <h2 class="title card-title">
                            <a href="{{ url('adds/single/' . $unit->id) }}">{{ $unit->title }}</a>
                        </h2>

                        <div class="card-actions">
                            <button class="btn btn-primary subscribe" data-type="meet" data-id="{{ $unit->id }}">
                                Пойду
                            </button>
                            <button class="btn subscribe" data-type="subscribe" data-id="{{ $unit->id }}">
                                Интересно
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    @if($subscribes_old)
        <h1 class="title container-title"><i class="icon-heart-empty"></i>Архив интересов</h1>
        <div class="adds-zone flex-m-col">
            @foreach($subscribes_old as $unit)
                <div class="card">
                    <a href="{{ url('adds/single/' . $unit->id) }}">
                        <div class="card-image" style="background-image: url({{ asset($unit->image) }})"></div>
                    </a>

                    <div class="card-content">
                        <h2 class="title card-title">
                            <a href="{{ url('adds/single/' . $unit->id) }}">{{ $unit->title }}</a>
                        </h2>

                        <div class="card-actions">
                            <button class="btn btn-primary subscribe" data-type="meet" data-id="{{ $unit->id }}">
                                Пойду
                            </button>
                            <button class="btn subscribe" data-type="subscribe" data-id="{{ $unit->id }}">
                                Интересно
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection