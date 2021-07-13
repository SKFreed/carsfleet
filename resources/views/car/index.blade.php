@extends('layouts.app')

@section('content')
    <div class="container">
        <div><h1>{{ $namePark }}</h1>
            <a href="{{ route('park.car.create',$idPark) }}" class="btn btn-primary">Добавить Автомобиль</a>
        </div>
        <div>
            <table class="table"> {{--Класс оформления таблицы--}}
                <thead>
                <tr>
                    <th>Имя владельца</th>
                    <th>Номер автомобиля</th>
                    <th>Действия</th>
                </tr>
                </thead>
                <tbody>

                @foreach($parks as $park)
                    <tr>
                        <td>{{ $park->driver }}</td>
                        <td>{{ $park->number }}</td>
                        <td>
                            {!! Form::open(['method' => 'DELETE','route' => ['park.car.destroy',$idPark, $park->id, ],'style'=>'display:inline']) !!}
                            {!! Form::button('Удалить', ['class' => 'btn btn-outline-danger', 'type' => 'submit']) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
        </div>
    </div>
@endsection
