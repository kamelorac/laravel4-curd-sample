@extends('layout.master')



@section('login')
<div class="col-md-12">
  @include('layout.notification')
</div>

<div class="col-md-4">
{{ Form::open(array('url' => 'user/login', 'id' => 'frmLogin')) }}

	<div class="form-group">
	    {{ Form::label('inputEmail', 'Email address') }}
	    {{ Form::text('inputEmail', '', $attributes = array('class'=>'form-control', 'placeholder' => 'Enter email')) }}
  	</div>
	

	<div class="form-group">
	    {{ Form::label('inputPassword', 'Password') }}
	    {{ Form::password('inputPassword',  $attributes = array('class'=>'form-control', 'placeholder' => 'Password')) }}
  	</div>


  	<div class="form-group">
    
      <div class="checkbox">
        <label>
          {{ Form::checkbox('remember', '1') }} Remember me
        </label>
      </div>
    
	</div>

	<div class="form-group">
	    {{ Form::submit('Sign in', $attribute = array('class'=>'btn btn-default', 'id' => 'btnLogin')) }}
  	</div>

  	<hr/>
  	<p>
  		{{ link_to('#', "Forget password ?", $attributes = array(), $secure = null) }}
  	</p>
  	<p>
  		{{ link_to('user/register', "Create a new account", $attributes = array(), $secure = null) }}
  	</p>

{{ Form::close() }}
</div>
@endsection


@section('notification')
  @if (isset($hasMessage))
  <div class="col-md-12">
    <!-- info, success, warning, danger -->
    <div class="alert alert-{{$msgType}}" role="alert">
      <strong>{{$msgTitle}}</strong> {{$msgMessage}}.
    </div>
    
  </div>
  @endif
@endsection

    
