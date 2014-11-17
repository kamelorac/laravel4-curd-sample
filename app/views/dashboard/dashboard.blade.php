@extends('layout.master')

@section('content')
<div class="clr"></div>
<div class="landing_title col-md-12">
	<div class="col-md-9">
    	<span class="pate_title">Dashboard</span>
  	</div>

	<div class="col-md-3 user_content">
		@if (Auth::check())
		 @include('layout.usernav')
		@endif
	</div>
</div>
<div class="clr"></div>


<div class="modal" id="myModal">
	<div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title">New Post</h4>
        </div>
        <div class="modal-body">
        	Do you wants to Create Profile Account with <span style="color:green;font-weight:bold">{{Auth::user()->email}}</span> ?
        </div>
        <div class="modal-footer">
          
         
		 {{link_to('#', "&nbsp;&nbsp;&nbsp; Yes &nbsp;&nbsp;", $parameters = array("id"=> Auth::user()->id ), $attributes = array("class"=>"btn btn-primary"))}}
          {{link_to('#', "&nbsp;&nbsp;&nbsp; No &nbsp;&nbsp;", $parameters = array("id"=> "" ), $attributes = array("class"=>"btn btn-primary"))}}
     	</div>
      </div>
    </div>
</div>
<div class="row" style="margin-top:10px;">
	<div class="col-md-12">
		<div id="no-more-tables" class="tbl">
		 <table class="table-bordered table-striped table-condensed cf" id="tblContainer" style="width: 100%">
	            <thead class="cf">
	          
	                <tr>
	                    <th class="header" width="5%" style="text-align:center">#</th>
	                    <th class="header" width="85%">Post</th>
	                    <th class="header" width="10%">Track</th>
	                   
	                </tr>
	            </thead>
			<tbody>
		  		<tr>
		  			<td style="text-align:center">1</td>
		  			<td data-title="Song">Diary</td>
		  			<td data-title="Track">5</td>
		  		</tr>
		  		<tr>
		  			<td style="text-align:center">2</td>
		  			<td data-title="Song">Eain Met Kabyar</td>
		  			<td data-title="Track">3</td>
		  		</tr>
		  		<tr>
		  			<td style="text-align:center">3</td>
		  			<td data-title="Song">Nge Yae La Min</td>
		  			<td data-title="Track">5</td>
		  		</tr>
	  		</tbody>
		</table>
	</div>
	</div>
</div>


<script type="text/javascript">
$(document).ready(function(){
	
	
	$('#openBtn').click(function(){
	$('#myModal').modal({show:true})

	return false;
	});

	
})
</script>
@endsection

    
