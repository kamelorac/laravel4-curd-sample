@extends('layout.master')
@section('content')
<div class="landing_title col-md-12">
  <div class="col-md-9">
      <span class="pate_title">New Post</span>
  </div>
  <div class="col-md-3 user_content">
     @include('layout.usernav')
  </div>
</div>

<div class="row st-row">
  <div class="col-md-12">
    @include('layout.notification')
  </div>
</div>



{{ isset($data['id']) ? Form::open(array('action' => array('PostController@postUpdate', $data['id']))) :
Form::open(array('action' => 'PostController@postStore')) }}

<div class="row">
  <div class="col-md-3">
    <label>Name</label>
      {{ Form::text('title', isset($data["title"])? $data['title'] : '' , $attributes = array( 'class'=>'form-control', 'placeholder' => 'what is on your mind?')) }}
  </div>
  
</div>

<div class="row" style="margin-top:20px">
   <div class="col-md-3">
    {{ Form::submit('Save', $attribute = array('class'=>'btn btn-default', 'id' => 'btnSave')) }}
    {{ link_to('dashboard', "PostList", $attributes = array('class' => 'btn'), $secure = null) }}
  </div>
</div>
{{ Form::close() }}

@endsection

