@extends('layouts.main')

@section('content')

    <div class="row">
        
        <div class="col-md-4">

        </div>

        <div class="col-md-4">

            {{ Form::open(array('url'=>'users/create', 'class'=>'form-signup')) }}
                <h2 class="form-signup-heading">Registration</h2>
             
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                
                <div class="form-group">
                    {{ Form::text('email', null, array('class'=>'form-control input-block-level', 'placeholder'=>'Email Address')) }}
                </div>

                <div class="form-group">
                    {{ Form::password('password', array('class'=>'form-control input-block-level', 'placeholder'=>'Password')) }}
                </div> 

                <div class="form-group">
                    {{ Form::password('password_confirmation', array('class'=>'form-control input-block-level', 'placeholder'=>'Confirm Password')) }}
                </div>

                <div class="form-group">
                    {{ Form::submit('Register', array('class'=>'btn btn-primary'))}}
                </div>
                
            {{ Form::close() }}


        </div>

        <div class="col-md-4">

        </div>

    </div>

@stop
