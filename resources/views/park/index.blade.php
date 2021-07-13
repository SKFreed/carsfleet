@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div>
                    <a href="{{ route('park.create') }}" class="btn btn-primary">Добавить Парк</a>
                </div>
                <div>
                    <table class="table"> {{--Класс оформления таблицы--}}
                        <thead>
                        <tr>
                            <th>Имя</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($parks as $park)
                            <tr>
                                <td>{{ $park->name }}</td>
                              <td>{!! Form::open(['method' => 'DELETE','route' => ['park.destroy', $park->id],'style'=>'display:inline']) !!}
                                    <a class="btn btn-outline-info" href="{{ route('park.car.index', $park->id) }}">Просмотр</a>

                                    <a class="btn btn-outline-info" href="{{ route('park.edit', $park->id) }}">Редактировать</a>

                                {!! Form::button('Удалить', ['class' => 'btn btn-outline-danger', 'type' => 'submit']) !!}
                                {!! Form::close() !!}
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    {{ $parks->render() }} {{--Пагинатор, кнопки переключения--}}
                </div>



            </div>
        </div>
    </div>
@endsection
