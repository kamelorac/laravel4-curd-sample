<?php
use Models\Post;

class PostController extends \BaseController {
	
	public function getIndex($id=null)
	{
		$posts = Post::orderBy('title','asc')->paginate(5);
		if(is_null($id)){
			return View::make('dashboard.post.postList',array("posts"=>$posts));
		}else{
			$msg = array(
				'hasMessage' => true, 
				'msgType' => 'success', 
				'msgTitle' => 'Success!', 
				'msgMessage' => 'Your post has been successfully posted'
			);
			return View::make('dashboard.post.postList',$msg,array("posts"=>$posts));
		}
	}


	public function postSearch(){
		$name = Request::get('inputSearchName');
		if(empty($name)){
			return $this->getIndex();
		}else{
			$posts = Post::where('name', 'LIKE', '%'. $name .'%')->orderBy('title','asc')->paginate(5);
			return View::make('dashboard.post.postList', compact('posts'),array("data"=>$posts,"keyword" => $name))->with("posts",$posts);

		}
	}
	/* For Pagination Error with POST */
	public function getSearch(){
		return $this->postSearch();
	}

	public function getCreate()
	{
		return View::make('dashboard.post.postForm');
	}


	public function postStore()
	{
		/** COLLECT DATA **/
		$postData = array(
			'user_id' => Auth::id(),
			'title' => Request::get('title')
		);

		/** VALIDATE REQUEST BEFORE SAVE **/
		$post = new Post;
		if ($post->validate($postData))
		{
		    $post = Post::create($postData);

		    /** CHECK SAVED CONDITION **/
		    if (!$post) {
				return Redirect::action('PostController@getEdit', array('id' => $post->id, 'type' => 'error'));				
			}
			return Redirect::action('PostController@getEdit', array('id' => $post->id, 'type' => 'save'));
		}
		else
		{
		    /** RESPONSE VALIDATION ERROR **/

		    $error = $post->errors();
		    return View::make('dashboard.post.postForm',array(
				'hasMessage' => true, 
				'msgType' => 'danger', 
				'msgTitle' => 'Validation Error : ', 
				'msgMessage' => $error->first('title')
				));
		}
	}


	public function show($id)
	{
		//
	}


	public function getEdit($id,$type=null)
	{
		switch ($type) {
			case 'save':
					$msg = array(
					'hasMessage' => true, 
					'msgType' => 'success', 
					'msgTitle' => 'Success!', 
					'msgMessage' => 'Post has been successfully created'
				);
				break;
			case 'update':
					$msg = array(
					'hasMessage' => true, 
					'msgType' => 'success', 
					'msgTitle' => 'Success!', 
					'msgMessage' => 'Post has been successfully updated'
				);
				break;
			case 'error':
					$msg = array(
					'hasMessage' => true, 
					'msgType' => 'danger', 
					'msgTitle' => 'Error!', 
					'msgMessage' => 'Error on server side.'
				);
				break;
		}

		/** FIND BY ID **/
		$post = Post::find($id);
		if(is_null($type)){
			return View::make('dashboard.post.postForm',array('data'=>Post::find($id)->toArray()));
		}else{
			return View::make('dashboard.post.postForm',$msg,array('data'=>Post::find($id)->toArray()));
		}
		
	}

	public function postUpdate($id)
	{
		/** FIND BY ID **/
		$currentPost = Post::find($id);

		/** COLLECT DATA **/
		$postData = array(
			'user_id' => Auth::id(),
			'title' => Request::get('title')
		);
		

		/** VALIDATE REQUEST BEFORE UPDATE **/
		$post = new Post;

		if ($post->validate($postData))
		{
		    $post = $currentPost->update($postData);

		    /** CHECK SAVED CONDITION **/
		    if (!$post) {
				return Redirect::action('PostController@getEdit', array('id' => $post->id, 'type' => 'error'));
			}
		}
		else
		{

		    /** RESPONSE VALIDATION ERROR **/
		    $error = $post->errors();
		    return View::make('dashboard.post.postForm',array(
				'hasMessage' => true, 
				'msgType' => 'danger', 
				'msgTitle' => 'Validation Error : ', 
				'msgMessage' => $error->first('title')
			));
		}

		/** RESPONSE IF SUCCESSED **/
		//dd($id);
		return Redirect::action('PostController@getEdit', array('id' => $id, 'type' => 'update'));
	}


	public function getDelete($id)
	{
		/** FIND BY ID **/
		$currentPost = Post::find($id);
		if (is_null($currentPost)) {
			return View::make('dashboard.post.postList',array(
				'hasMessage' => true, 
				'msgType' => 'danger', 
				'msgTitle' => 'Error', 
				'msgMessage' => 'Post ID: {$id} Not Found'
			));
		}
		$currentPost->delete();

		return Redirect::action('PostController@getIndex', array('id' => $id));
		
	}


}
