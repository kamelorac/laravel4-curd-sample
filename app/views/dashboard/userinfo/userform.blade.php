@extends('layout.master')

@section('content')
	
<div class="clr"></div>
<div class="landing_title col-md-12">
	<div class="col-md-9">
    	<span class="pate_title">{{ isset($user) ? 'Edit user' : 'Create new user' }}</span>
  	</div>

	<div class="col-md-3 user_content">
		@include('layout.usernav')
	</div>
</div>

<div class="row" style="margin-top:20px">
  <div class="col-md-12">
    @include('layout.notification')
  </div>
</div>
<div class="clr"></div>

<div class="col-md-12" style="margin:10px 0 0 0;">
	<div class="col-md-4">
		{{ isset($user) ? Form::model($user, array('action'=>array('UserController@postEdit', $user->id))) : Form::open(array('action'=>'UserController@postNew')) }}

		<div class="form-group">
		    {{ Form::label('inputName', 'Name') }}
		    {{ Form::text('inputName', isset($user) ? $user->name : '', array('class'=>'form-control', 'placeholder' => 'Enter name')) }}
	  	</div>
		
		<div class="form-group">
		    {{ Form::label('inputEmail', 'Email address') }}
		    {{ Form::text('inputEmail', isset($user) ? $user->email : '', array('class'=>'form-control', 'placeholder' => 'Enter email')) }}
	  	</div>

	  	<div class="form-group">
	      	{{ Form::label('inputPassword', 'Password') }}
	      	{{ isset($user) ? Form::password('inputPassword', array('class'=>'form-control', 'placeholder' => 'To change, enter new password. Or leave blank.')) : Form::password('inputPassword', array('class'=>'form-control', 'placeholder' => 'Enter password')) }}
	    </div>
	    	    
	  	<div class="form-group">
		    {{ Form::label('inputRole', 'User\'s role') }}
		    {{ Form::select('inputRole', array('user' => 'User', 'admin'=>'Administrator'), isset($user) ? $user->role : '', array('class' => 'form-control')) }} 
	  	</div>
		
	  	<div class="form-group">
		    {{ Form::submit('Save', $attribute = array('class'=>'btn btn-default', 'id' => 'btnCreate')) }}
		    {{ link_to('user', "To all users", $attributes = array('class' => 'btn'), $secure = null) }}
	  	</div>

	  	{{ Form::close() }}
	</div>
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