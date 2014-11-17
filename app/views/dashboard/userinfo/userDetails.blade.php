@extends('layout.master')
@section('content')
<div class="clr"></div>
<div class="landing_title col-md-12">
	<div class="col-md-9">
    	<span class="pate_title">User Information</span>
  	</div>

	<div class="col-md-3 user_content">
		 @include('layout.usernav')
	</div>
</div>
<div class="clr"></div>
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h4 class="modal-title">Create Profile</h4>
      </div>
      <div class="modal-body">
        Do you want to Create Profile Account with <span style="color:green;font-weight:bold">{{Auth::user()->email}}</span> ?
      </div>
      <div class="modal-footer">
        {{ link_to_action('ProfileController@getUser', "&nbsp;&nbsp;&nbsp; Yes &nbsp;&nbsp;", $parameters = array("id"=> Auth::user()->id ), $attributes = array("class"=>"btn btn-primary")) }}
        {{ link_to_action('ProfileController@getUser', "&nbsp;&nbsp;&nbsp; No &nbsp;&nbsp;", $parameters = array("id"=> "" ), $attributes = array("class"=>"btn btn-primary")) }}
      </div>
    </div>
  </div>
</div>
<div class="row st-row">
  <div class="col-md-2">
    <div class="img-thumbnail" style="background-color:#c2c2c2;"> 
      <div style="padding:40px 30px 30px 30px;color:#fff;font-size:16px;font-weight:bold;">No Photo!</div>
      <div style="text-align:center">
        <ul class="nav nav-pills">
          <li >
            {{ link_to_action('ProfileController@getProfiledetails', "Edit", $parameters = array("id"=> Auth::user()->id ), $attributes = array("style"=>"text-align:center;display:block")) }}
          </li>
        </ul>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <label class="glyphicon glyphicon-user"> : </label>
    {{ Form::label('inputName', isset($user["name"]) ? $user['name'] : '', array('style'=>'font-weight:bold')) }} <br />
    <label class="glyphicon glyphicon-envelope"> : </label>
    {{ Form::label('inputEmail', isset($user["email"]) ? $user['email'] : '', array('style'=>'font-weight:bold')) }} <br />
    <label class="glyphicon glyphicon-list-alt"> : </label>
    <label class="badge" style="font-weight:bold">{{ count($profiles) }} </label> profile(s) <br />
    <label class="glyphicon glyphicon-list-alt" style="opacity: 0;"> : </label>
    <label class="badge" style="font-weight:bold">{{ count($songs) }} </label> song(s)
    <!-- {{ Form::label('inputProfileCount', count($profiles), array('style'=>'font-weight:bold','class'=>'badge')) }} --><br />      
  </div>
  <div class="col-md-4">
    <label class="glyphicon glyphicon-log-in"> : </label>
    {{ date("d M Y",strtotime(isset($user["updated_at"]) ? $user['updated_at'] : '')) }} ( last login ) <br />
    <label class="glyphicon glyphicon-flag"> : </label> Active
  </div>
  <div class="col-md-2">
    {{ link_to_action('UserController@getEdit', 'Edit user', array('id' => $user['id']), array('class' => 'minibutton sidebar-button')); }}
    <!-- <a class="minibutton sidebar-button" href="/user">To all users</a> -->
    {{ link_to_action('UserController@getIndex', 'To all users', array(), array('class' => 'minibutton sidebar-button')); }}
  </div>
</div>

<!-- Grid control for profiles -->
<!-- {{ Form::open(array('action' => 'ProfileController@postSearch')) }} -->
<div class="row search_container st-row">
	<div class="col-md-3">
    	<!-- {{ Form::text('inputSearchName', '' , $attributes = array( 'class'=>'form-control', 'placeholder' => 'Search name')) }}   -->
    Profiles belonged to {{ $user['name'] }}
  </div>
  <div class="col-md-3">
   	<div style="margin-top:3px"></div>
      	<!-- {{ Form::submit('Search', $attribute = array('class'=>'btn btn-default', 'id' => 'btnSearch')) }} -->
    		<!-- <a href="" id="openBtn" class="btn">Create Profile</a> -->
  </div>
  <div class="col-md-3" style="float:right">
   	{{ $profiles->links() }} <!-- pagination control -->
  </div>
</div>
<!-- {{ Form::close() }} -->
<div id="no-more-tables" class="tbl">
  <table class="table-bordered table-striped table-condensed cf" id="tblContainer" style="width: 100%">
   	<thead class="cf">
      <tr>
       	<th class="header" width="3%">No</th>
       	<th class="header" width="30%">Name</th>
       	<th class="header" width="30%">Email</th>
       	<th class="header" width="20%">Category</th>
       	<th class="header" width="5%"># Songs</th>
       	<th class="header" width="10%">Actions</th>
      </tr>
   	</thead>
   	<tbody>
   	@if (count($profiles) > 0)
  		@foreach($profiles as $profile)  
   	  	<tr>
          <td class='form_id' data-title="NO" style="text-align:center">1</td>
	        <td data-title="Name">{{ $profile->name }}</td>
	        <td data-title="Email">{{ $profile->email }}</td>
	        <td data-title="Type">{{ $profile->category }}</td>
          <td data-title="No of Songs" style="text-align:center"><span class="badge">{{ $sng_count_prf[$profile->id] }}</span></td>
	        <td style="text-align:center">
            <a href="#"><span class="glyphicon glyphicon-info-sign"></span></a>&nbsp;&nbsp;
            <a href="{{ URL::to('profile/index/'.$profile->id) }}"><span class="glyphicon glyphicon-edit"></span></a>&nbsp;&nbsp;
            <a href="{{ URL::to('profile/index/'.$profile->id) }}"><span class="glyphicon glyphicon-trash"></span></a>
	        </td>
        </tr>
      @endforeach
    @else
      <h5 class="errorslist">You have no profile. Click to create a profile button</h5>
    @endif
    </tbody>
  </table>
</div>
<div class="clr" style="margin-top: 10px;"></div>
   
<!-- Grid control for songs -->
<!-- {{ Form::open(array('action' => 'ProfileController@postSearch')) }} -->
<div class="row search_container st-row">
  <div class="col-md-3">
    <!-- {{ Form::text('inputSearchName', '' , $attributes = array( 'class'=>'form-control', 'placeholder' => 'Search name')) }} -->
    Songs uploaded by {{ $user['name'] }}
  </div>
	<div class="col-md-3">
		<div style="margin-top:3px"></div>
    <!-- {{ Form::submit('Search', $attribute = array('class'=>'btn btn-default', 'id' => 'btnSearch')) }} -->
    <!-- <a href="" id="openBtn" class="btn">Upload Songs</a> -->
  </div>
  <div class="col-md-3" style="float:right">
    {{ $songs->links() }} <!-- pagination control -->
  </div>
</div>
<!-- {{ Form::close() }} -->
<div id="no-more-tables" class="tbl">
  <table class="table-bordered table-striped table-condensed cf" id="tblContainer" style="width: 100%">
    <thead class="cf">
      <tr>
        <th class="header" width="3%">No</th>
        <th class="header" width="30%">Title</th>
        <th class="header" width="30%">Album</th>
        <th class="header" width="15%">Genre</th>
        <th class="header" width="10%">Status</th>
        <th class="header" width="10%">Actions</th>
      </tr>
    </thead>
    <tbody>
    @if (count($songs) > 0)
    	@foreach($songs as $song)  
       	<tr>
        	<td class='form_id' data-title="NO" style="text-align:center">1</td>
	        <td data-title="Title">{{ $song->mm_title }}</td>
	        <td data-title="Album">{{ $song->album }}</td>
	        <td data-title="Genre">{{ $song->genre }}</td>
          <td data-title="Status">{{ $song->status }}</td>
	        <td style="text-align:center">
            <a href="#"><span class="glyphicon glyphicon-info-sign"></span></a>&nbsp;&nbsp;
            <a href="{{ URL::to('profile/index/'.$profile->id) }}"><span class="glyphicon glyphicon-edit"></span></a>&nbsp;&nbsp;
            <a href="{{ URL::to('profile/index/'.$profile->id) }}"><span class="glyphicon glyphicon-trash"></span></a>
	        </td>
        </tr>
      @endforeach
    @else
      <h5 class="errorslist">You have not uploaded any song. To upload songs, click the Upload Songs button above.</h5>
    @endif
    </tbody>
  </table>
</div>

<script type="text/javascript">
  $(document).ready(function(){
	  $('td.form_id').each(function(i){
      $(this).text(i+1);
    });
        
  	$('#openBtn').click(function(){
    	$('#myModal').modal({show:true})
      	return false;
    	});
  })
</script>

@endsection
