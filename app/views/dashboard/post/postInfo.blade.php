@extends('layout.master')

@section('content')
<div class="clr"></div>

<div class="landing_title col-md-12">
	<div class="col-md-9">
    	<span class="pate_title">Song Info</span>
  	</div>

	<div class="col-md-3 user_content">
		 @include('layout.usernav')
	</div>
</div>

<div class="clr"></div>
   <div class="song_infos">
	   <h2>Mandatory info</h2>
	   	<p>
			Artist<span class="account-info">Kai Zar Tin Mone</span>
		</p>
		<p>
			Album<span class="account-info">Shunt Say Chay Htauk</span>
		</p>
		<p>
			Title<span class="account-info">A Mu A You </span>
		</p>
		<h2>Optional info</h2>
		<p>
			Genre<span class="account-info">Alternative</span>
		</p>
		<p>
			ISWC<span class="account-info">-</span>
		</p>
		<p>
			Entitled person	<span class="account-info">-</span>
		</p>
		<p>
			Publisher<span class="account-info">-</span>
		</p>
		<p>
			Sub publisher<span class="account-info">-</span>
		</p>
		<p>
			Country<span class="account-info">-</span>
		</p>
		<p>
			Composer<span class="account-info">No</span>
		</p>
		<p>
			Author<span class="account-info">No</span>
		</p>
		<p>
			Interpret<span class="account-info">No</span>
		</p>
   </div>

@endsection

    
