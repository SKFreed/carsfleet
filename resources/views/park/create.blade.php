@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="form-group required">
            {{ Form::open(array('route' => array('park.store'), 'method' => 'post')) }}
            <div class="park-form">
            <h4>Автопарк</h4>


            <div class="park-input">
                {{ Form::label('name', 'Название') }}
                {{ Form::text('name','',array('class' => 'form-control')) }}
            </div>
            <div class="park-input">
                {{ Form::label('asdress', 'Адрес') }}
                {{ Form::text('asdress','',array('class' => 'form-control')) }}
            </div>
            <div class="park-input">
                {{ Form::label('schedule', 'График работы') }}
                {{ Form::text('schedule','',array('class' => 'form-control')) }}
            </div>
            </div>
        <hr>



            <div class="well well-sm clearfix">
                <button class="btn btn-success pull-right" type="submit">Добавить</button>
            </div>
            {{ Form::close() }}


    </div>

    </div>
@endsection
