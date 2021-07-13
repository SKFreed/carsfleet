@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="form-group required">
            {{ Form::open(array('route' => array('park.car.store',$idPar), 'method' => 'post')) }}

            <div>

            <h4>Машины</h4>

            <div class="car-center">
                <div class="car-line">
                    {{ Form::label('driver', 'Имя водителя') }}
                    {{ Form::text('driver','',array('class' => 'form-control')) }}
                    {{ Form::text('driver1','',array('class' => 'form-control')) }}
                </div>
                <div class="car-line">
                    {{ Form::label('number', 'Номер машины') }}
                    {{ Form::text('number','',array('class' => 'form-control')) }}
                    {{ Form::text('number1','',array('class' => 'form-control')) }}
                </div>
            </div>


            <div class="well well-sm clearfix">
                <button class="btn btn-success pull-right" type="submit">Добавить</button>
            </div>
            {{ Form::close() }}


        </div>

    </div>
@endsection
