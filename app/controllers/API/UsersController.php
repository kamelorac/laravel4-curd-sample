<?php
namespace Controllers\API;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Request;
use Illuminate\Routing\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

use Models\User, Input;

class UsersController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /users
	 *
	 * @return Response
	 */
	public function index()
	{
		
		/** REQUEST DATA TO FILTER **/
		$per_page 	= Input::get('per_page');		
		$sortby		= Input::get('sortby');
		$order 		= Input::get('order');
		$role 		= Input::get('role');

		if(!$order){
			$order = 'asc';
		}
		if ($sortby && $order) {
	       	$users = User::orderBy($sortby,$order)->paginate($per_page);
    	} else {
        	$users = User::paginate($per_page);
    	}

    	if($role){
    		$users = User::where('role', '=', $role)->paginate($per_page);
    	}

    	/** CHECK WHETHER DATA EXIT OR NOT **/
		if (is_null($users)) {
			$response = array(
				'devMessage'    => "No Content",
				'userMessage'   => 'No user content',
				'errorCode'     => '204',
				'moreInfo'      => 'http://developers.songtrek.com/errors/204'
			);

			return Response::json($response, 204);
		}

		/** RESPONSE IF SUCCESSED **/
		return Response::json(array('status' => 'success', 'users' => $users->toArray()),200);
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /users/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//

	}

	/**
	 * Store a newly created resource in storage.
	 * POST /users
	 *
	 * @return Response
	 */
	public function store()
	{
		
		/** COLLECT DATA **/
		if(is_null(Request::get('role'))){
			$role = 'user';
		}
		$userData = array(
			'name' => Request::get('name'),
		    'password' => Request::get('password'),
		    'email' => Request::get('email'),
		    'role' => $role
		);

		/** VALIDATE REQUEST BEFORE SAVE **/
		$user = new User;
		if ($user->validate($userData))
		{
			$userData['password'] = Hash::make(Request::get('password'));
		    $user = User::create($userData);

		    /** CHECK SAVED CONDITION **/
		    if (!$user) {
				$response = array(
					'devMessage'    => "Internal Server Error",
					'userMessage'   => 'Create user failed',
					'errorCode'     => '500',
					'moreInfo'      => 'http://developers.songtrek.com/errors/500'
				);

				return Response::json($response, 500);
			}
		}
		else
		{
		    /** RESPONSE VALIDATION ERROR **/
		    return Response::json(array('Validation Error' => $user->errors()),400);
		}

		/** RESPONSE IF SUCCESSED **/
		return Response::json(array('status' => 'success','user' => $user->toArray()));
	}

	/**
	 * Display the specified resource.
	 * GET /users/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		/** FIND BY ID **/
		if(is_numeric($id)){
			$currentUser = User::find($id);
			if (is_null($currentUser)) {
				$response = array(
					'devMessage'    => "User with id '{$id}' not found",
					'userMessage'   => 'User not found',
					'errorCode'     => '0404',
					'moreInfo'      => 'http://developers.songtrek.com/errors/0404'
				);

				return Response::json($response, 404);
			}

			return Response::json(array('status' => 'success', 'user' => $currentUser->toArray()));	
		}else{
			$this->filter($id);
		}

		
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /users/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
		return "HI " . $id;
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /users/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		/** REQUEST ALL DATA **/
		$userData = Request::all();

		/** FIND BY ID **/
		$currentUser = User::find($id);

		/** VALIDATE REQUEST BEFORE UPDATE **/
		$user = new User;

		$userFields = $currentUser->toArray();

		/** ADDED HIDDEN FILED **/
		$userFields["password"] = null;



		/** VALIDATE REQUEST BEFORE UPDATE **/
		foreach ($userFields as $key => $value) {
			if($key == 'id'){continue;}
			else{
				if(array_key_exists($key,$userData) == false){
					$user->rules[$key] = '';
				}
			}
		}

		if ($user->validate($userData))
		{	
		    
		    /** CONVERT HASH WITH ADDTIONAL ARRAY **/
		    if(Request::get('password')){
		    $userData['password'] = Hash::make(Request::get('password'));
		    	//$user = $currentUser->update($userData);
			}
			$user = $currentUser->update($userData);
			
		    /** CHECK SAVED CONDITION **/
		    if (!$user) {
				$response = array(
					'devMessage'    => "Internal Server Error",
					'userMessage'   => 'Update user failed',
					'errorCode'     => '500',
					'moreInfo'      => 'http://developers.songtrek.com/errors/500'
				);

				return Response::json($response, 500);
			}
		}
		else
		{
		    /** RESPONSE VALIDATION ERROR **/
		    return Response::json(array('Validation Error' => $user->errors()),400);
		}

		/** RESPONSE IF SUCCESSED **/
		return Response::json(array('status' => 'success', 'user' => $currentUser->toArray()));
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /users/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		/** FIND BY ID **/
		$currentUser = User::find($id);
		if (is_null($currentUser)) {
			$response = array(
				'devMessage'    => "User with id '{$id}' not found",
				'userMessage'   => 'User not found',
				'errorCode'     => '0404',
				'moreInfo'      => 'http://developers.songtrek.com/errors/0404'
			);
			return Response::json($response, 404);
		}

		//Need To Handle Foreign Key Exception

		$currentUser->delete();
		return Response::json(array('status' => 'success', 'user' => $currentUser->toArray()));
	}

}