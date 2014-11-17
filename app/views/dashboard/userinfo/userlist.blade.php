@extends('layout.master')

@section('listallusers')

<div class="landing_title col-md-12">
	<div class="col-md-9">
    	<span class="pate_title">User</span>
  	</div>

	<div class="col-md-3 user_content">
		 @include('layout.usernav')
	</div>
</div>


<div class="row st-row"></div>

{{ Form::open(array('action' => array('UserController@postSearch'))) }}
<div class="row search_container">
    <div class="col-md-2">
        {{ Form::text('inputSearchName', isset($keyword)? $keyword : '', $attributes = array( 'class'=>'form-control', 'placeholder' => 'Search name')) }}  
    </div>
    <div class="col-md-3">
        <div style="margin-top:3px"></div>
         {{ Form::submit('Search', $attribute = array('class'=>'btn btn-default', 'id' => 'btnSearch')) }}
          {{link_to('user/new', "New User", $attributes = array('class' => 'btn'), $secure = null)}}
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
<!-- Start List Table -->
<div class="row">
<div class="col-md-12">
		<div id="no-more-tables" class="tbl">
			<table class="table-bordered table-striped table-condensed cf" id="tblContainer" style="width: 100%">
				<thead class="cf">          
			    	<tr>
			            <th class="header" width="2%" style="text-align:center">#</th>
			            <th class="header" width="20%">Username</th>
			            <th class="header" width="35%">Email</th>
			            <th class="header" width="5%"># Posts</th>
			       		<th class="header" style="transparent:true;" width="10%">Actions</th>
			    	</tr>
				</thead>
				<tbody>	
					<?php
						$i = 0;
					?>
					@foreach ($users as $user)
						<tr>
							<td style='text-align:center'>{{ $i = $i + 1; }}</td>
							<td data-title='Username'>{{$user->name}}</td>
							<td data-title='Email'>{{ $user->email }}</td>
							<td data-title='NumOfProfs' align="center">
								<span class="badge"></span>
							</td>
							<td>
								<a href="{{ URL::to('user/show/'.$user->id) }}">
			                      <span class="glyphicon glyphicon-info-sign"></span>
			                    </a>&nbsp;&nbsp;

			                    <a href="{{ URL::to('user/edit/'.$user->id) }}">
			                      <span class="glyphicon glyphicon-edit"></span>
			                    </a>&nbsp;&nbsp;

			                    <a href="{{ URL::to('user/edit/'.$user->id) }}">
			                      <span class="glyphicon glyphicon-trash"></span>
			                    </a>
							</td>
						</tr>
					@endforeach				
				</tbody>
			</table>
		</div>
	</div>

</div>
<!-- End List Table -->
@endsection

<?php
// 	use Models\Profile;

// 	// Return the total number of profiles by user
// 	function getCount($id)
// 	{
// 		return Profile::where('user_id', '=', $id)->count();
// 	}
// ?>
