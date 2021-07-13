@extends('layouts.app')

@section('content')
    <div class="container">
        {{ Form::model($park, array('route' => array('park.update', $park->id), 'method' => 'PUT', 'files'=>true)) }}
        <div class="col-md-6">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="form-group required">
                {!! Form::label("Наименование категории") !!}
                {!! Form::text("name", null ,["class"=>"form-control","required"=>"required"]) !!}
            </div>
        </div>
        <div class="well well-sm clearfix">
            <button class="btn btn-success pull-right" type="submit">Изменить</button>
            <a href="#" class='btn' onclick="history.back();"><i class="fas fa-arrow-alt-circle-left" style="color: #0471d0; font-size: 30px" title="Назад"></i></a>
        </div>
        {!! Form::close() !!}
    </div>
@endsection
