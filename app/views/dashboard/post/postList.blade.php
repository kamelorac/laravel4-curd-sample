@extends('layout.master')

@section('content')
<div class="clr"></div>

<div class="landing_title col-md-12">
	<div class="col-md-9">
    	<span class="pate_title">Posts</span>
  	</div>

	<div class="col-md-3 user_content">
		 @include('layout.usernav')
	</div>
</div>
<div class="col-md-12">
	<h3>Posts</h3>
</div>
<div class="row st-row"></div>

{{ Form::open(array('action' => array('UserController@postSearch'))) }}
<div class="row search_container">
    <div class="col-md-2">
        {{ Form::text('inputSearchName', isset($keyword)? $keyword : '', $attributes = array( 'class'=>'form-control', 'placeholder' => 'Search post')) }}  
    </div>
    <div class="col-md-3">
        <div style="margin-top:3px"></div>
         {{ Form::submit('Search', $attribute = array('class'=>'btn btn-default', 'id' => 'btnSearch')) }}
          {{link_to('post/create', "New Post", $attributes = array('class' => 'btn'), $secure = null)}}
    </div>
    <div class="col-md-3" style="float:right">
       
    </div>
</div>
{{ Form::close() }}

<!-- Start Notification -->
<div class="row">
  <div class="col-md-12">
    @include('layout.notification')
  </div>
</div>
<!-- End Notification -->
<div class="clr"></div>

   <div id="no-more-tables" class="tbl">

        <table class="table-bordered table-striped table-condensed cf" id="tblContainer" style="width: 100%">
            <thead class="cf">
          
                <tr>
                    <th class="header" width="1%" style="text-align:center">{{ Form::checkbox('chk', 1, true) }}</th>
                    <th class="header" width="20%">Title</th>
                    <th class="header" width="10%">Action</th>
                </tr>
            </thead>
            <tbody>
               @foreach($posts as $post)  
                <tr>
                    <td style="text-align:center" id="{{$post->id}}">{{ Form::checkbox('chk')}}</td>
                    <td data-title="Title">{{$post->title}}</td>
                    <td style="text-align:center">
                            <a href="#">
                              <span class="glyphicon glyphicon-info-sign"></span>
                            </a>&nbsp;&nbsp;

                            <a href="{{ URL::to('post/edit/'.$post->id) }}">
                              <span class="glyphicon glyphicon-edit"></span>
                            </a>&nbsp;&nbsp;

                            <a href="{{ URL::to('post/delete/'.$post->id) }}">
                              <span class="glyphicon glyphicon-trash"></span>
                            </a>
                    </td>
                </tr>
                  @endforeach
              
            </tbody>
        </table>
    </div>
</div>
@endsection

    
