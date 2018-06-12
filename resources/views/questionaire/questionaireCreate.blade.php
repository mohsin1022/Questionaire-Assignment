@extends('layouts.app')

@section('content')
<div class="flex-center position-ref full-height container">
    <h3 class="page-title">{{ isset($questionaire)&& $questionaire ? 'Edit Questionaire': 'Add Questionaire' }}</h3>
   
        {!! Form::open(['method' => 'POST', 'route' => ['questionaire.store']]) !!}
   
    {!! Form::hidden('id', isset($questionaire->id) ? $questionaire->id : old('id') ) !!}
    <div class="panel panel-default">
       
        
        <div class="panel-body col-md-8">
            <div class="row">
                <div class="col-md-12 form-group">
                    {!! Form::label('nmae', 'Name*', ['class' => 'control-label']) !!}
                    {!! Form::text('name', isset($questionaire->name) ? $questionaire->name: old('name') ,['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('name'))
                        <p class="error text-danger">
                            {{ $errors->first('name') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                    <div class="col-md-8 form-group">
                        {!! Form::label('duration', 'duration*', ['class' => 'control-label']) !!}
                        {!! Form::number('duration', isset($questionaire->duration) ? $questionaire->duration: old('duration'), ['class' => 'form-control', 'placeholder' => '']) !!}
                        <p class="help-block"></p>
                        @if($errors->has('duration'))
                            <p class="error text-danger">
                                {{ $errors->first('duration') }}
                            </p>
                        @endif
                    </div>
                    <div class="col-md-4 form-group">
                        {!! Form::label('duration_type', 'Type', ['class' => 'control-label']) !!}
                        {!! Form::select('duration_type', ['minutes'=>'minutes','hours'=>'hours'], old('duration_type'), ['class' => 'form-control']) !!}
                        <p class="help-block"></p>
                        @if($errors->has('duration_type'))
                            <p class="help-block">
                                {{ $errors->first('duration_type') }}
                            </p>
                        @endif
                    </div>
                </div>
                
            <div class="row">
                <div class="col-md-12 form-group">
                    {!! Form::label('can_resume', 'Is Resumable ', ['class' => 'control-label']) !!}
                    {!! Form::radio('can_resume',1, old('can_resume'), ['class' => 'radio-inline', 'placeholder' => '',  'checked'=>isset($questionaire->can_resume) && $questionaire->can_resume  ?true:false ]) !!}
                    Yes
                    {!! Form::radio('can_resume',0, old('can_resume'), ['class' => 'radio-inline', 'placeholder' => '','checked'=>isset($questionaire->can_resume) && $questionaire->can_resume ? false:true]) !!}
                    No
                    <p class="help-block"></p>
                    @if($errors->has('can_resume'))
                        <p class="error text-danger">
                            {{ $errors->first('can_resume') }}
                        </p>
                    @endif
                </div>
            </div>

        </div>
    </div>

    {!! Form::submit('Save', ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
</div>
@stop

