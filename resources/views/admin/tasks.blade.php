@extends('app')

@section('content')
@include('includes/header-adm')
<div class="container">
    <div class="card">
        <div class="card-content">
            <title>Запросы</title>
            <h2 class="title card-title">Запросы</h2>
            <table class="table">
                @foreach($adds as $unit)
                    <tr class="adm-task">
                        <td><a href="{{ url('adds/single/' . $unit->title) }}">{{ $unit->title }}</a>
                        <td><input type="text" class="text task-reason" placeholder="Причина">
                        <td>
                            <form action="{{ url('admin/tasks/apply?id=' . $unit->id) }}" method="post">
                                <button class="btn" type="submit">Принять</button>
                                <input type="hidden" name="reason">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            </form>
                        <td>
                            <form action="{{ url('admin/tasks/reject?id=' . $unit->id) }}" method="post">
                                <button class="btn" type="submit" onclick="if(!checkReason($(this))) return false">Отклонить</button>
                                <input type="hidden" name="reason">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            </form>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
@endsection
