@extends('layout.master')

@section('register')
<div class="col-md-4">
{{ Form::open(array('action' => 'UserController@postRegister', 'id' => 'frmRegister')) }}
  <div class="form-group">
	 {{ Form::label('inputName', 'Name') }}
	 {{ Form::text('inputName', '', $attributes = array( 'class'=>'form-control', 'placeholder' => 'Enter name')) }}
  </div>
	
	<div class="form-group">
	 {{ Form::label('inputEmail', 'Email address') }}
	 {{ Form::text('inputEmail', '', $attributes = array( 'class'=>'form-control', 'placeholder' => 'Enter email address')) }}
  </div>

  <div class="form-group">
    {{ Form::label('inputPassword', 'Password') }}
    {{ Form::password('inputPassword',  $attributes = array('class'=>'form-control', 'placeholder' => 'Enter password')) }}
  </div>

  <div class="form-group">
    {{ Form::label('inputConfirmPassword', 'Confirm Password') }}
    {{ Form::password('inputConfirmPassword',  $attributes = array('class'=>'form-control', 'placeholder' => 'Confirm password')) }}
  </div>

	<div class="form-group">    
    <div class="checkbox">
      <label>
       	I have read and agreed to  {{ link_to('#', "Terms of Service", $attributes = array(), $secure = null) }} {{ Form::checkbox('terms', '1') }} 
      </label>
    </div>    
	</div>

	<div class="form-group">
	  {{ Form::submit('Create my account', $attribute = array('class'=>'btn btn-default', 'id' => 'btnRegister')) }}
  </div>
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