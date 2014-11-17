@extends('layout.master')

@section('profile')

<div class="col-md-12">
	<h3>Personal Information</h3>
	<hr/>
</div>
<div class="col-md-3">
	<div style="width:320px;height:280px;background-color:#c2c2c2;"class="img-thumbnail"> 
		<div style="margin:100px 0 0 25px;color:#fff;font-size:20px;font-weight:bold;">Sample Image Here!</div>
	</div>
</div>

<div class="col-md-4">
{{ Form::open(array('url' => '#', 'id' => 'frmRegister')) }}

	<div class="form-group">
	    {{ Form::label('inputName', 'Name') }}
	    {{ Form::text('inputName', '', $attributes = array( 'class'=>'form-control', 'placeholder' => 'Enter name')) }}
  	</div>
	
	<div class="form-group">
	    {{ Form::label('inputEmail', 'Email address') }}
	    {{ Form::text('inputEmail', '', $attributes = array( 'class'=>'form-control', 'placeholder' => 'Enter email')) }}
  	</div>

  	<div class="form-group">
	    {{ Form::label('inputStatus', 'Status') }}
  	</div>

	<div class="form-group">
    
      <div class="checkbox">
      	
        <label>
        	{{ Form::checkbox('status1', '1') }} Sample1 <br/>
        	{{ Form::checkbox('status1', '1') }} Sample2, Sample3, Sample4 <br/>
        	{{ Form::checkbox('status1', '1') }} Sample5 <br/>
        	{{ Form::checkbox('status1', '1') }} Sample6 <br/>
        	 
        </label>
      </div>
    
	</div>

  	

	<div class="form-group">
	    {{ Form::submit('Update my profile', $attribute = array('class'=>'btn btn-default', 'id' => 'btnRegister')) }}
  	</div>


{{ Form::close() }}
</div>


<div class="col-md-4">
{{ Form::open(array('url' => 'user/new', 'id' => 'frmRegister')) }}

	<div class="form-group">
      {{ Form::label('inputPassword', 'Password') }}
      {{ Form::password('inputPassword',  $attributes = array('class'=>'form-control', 'placeholder' => 'Password')) }}
    </div>
	
	<div class="form-group">
	    {{ Form::label('inputEmail', 'Confirm password') }}
	    {{ Form::text('inputEmail', '', $attributes = array( 'class'=>'form-control', 'placeholder' => 'Enter email')) }}
  	</div>

  

	

  	

	


{{ Form::close() }}
</div>

@endsection

    
