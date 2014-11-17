<?php
use Models\User;

class DashboardController extends \BaseController {

	public function getIndex(){
		$user_id = Auth::id();
		$posts=User::find($user_id)->posts;
		return View::make('dashboard.post.postlist')->with('posts',$posts);
	}

	public function getPosts(){

	}
}
