{{ Form::open(array('url'=>'users/signin', 'class'=>'form-signin')) }}

    <h2 class="form-signin-heading">Please Login</h2>
 
    <div class="form-group">
        {{ Form::text('email', null, array('class'=>'form-control input-block-level', 'placeholder'=>'Email Address')) }}
    </div>

    <div class="form-group">
        {{ Form::password('password', array('class'=>'form-control input-block-level', 'placeholder'=>'Password')) }}
    </div>

    <div class="form-group">
        {{ Form::submit('Login', array('class'=>'btn btn-large btn-primary btn-block'))}}
    </div>

{{ Form::close() }}
