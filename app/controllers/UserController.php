<?php
use Models\User;
use Models\Post;

class UserController extends BaseController {

	/*
	|
	| Return the list of all users
	|
	*/
	public function getIndex()
	{
		// return View::make('home.register');


		$users = User::all();
		return View::make('dashboard/userinfo/userlist', array('users'=>$users));
	}

	public function getRegister() {
		return View::make('home.register');
	}

	public function postRegister() {

		// Validate the input
		$input = array(
			'name' => Input::get('inputName'),
			'email' => Input::get('inputEmail'),
			'password' => Input::get('inputPassword')
		);

		$user = new User;
		if($user->validate($input)) {
			$password = Input::get('inputPassword');
			$confirmPassword = Input::get('inputConfirmPassword');
			// Confirm the password
			if($password != $confirmPassword) {
				return View::make('home.register', array(
					'hasMessage' => true, 
					'msgType' => 'warning', 
					'msgTitle' => 'Warning!', 
					'msgMessage' => 'Password did not match'
					)
				);
			}

			// Create the user
			$user = User::create(array(
				'name' => Input::get('inputName'),	
				'email' => Input::get('inputEmail'),
				'password' => Hash::make(Input::get('inputPassword')),
				'role' => 'user'
				)
			);
			
			// Go to login page
			if (!$user) {
				return Redirect::action('UserController@getRegister', array('id' => $user->id, 'type' => 'error'));				
			}

			return View::make('home.index',array(
				'hasMessage' => true, 
				'msgType' => 'success', 
				'msgTitle' => 'Success!', 
				'msgMessage' => 'Please login using your credentials'
				)
			);
		}
		else {
			$error = $user->errors();
			return View::make('home.register', array(
				'hasMessage' => true, 
				'msgType' => 'warning', 
				'msgTitle' => 'Warning!', 
				'msgMessage' => $error->first('name'). " " . $error->first('email')
				)
			);
		}
	}

	/*
	|
	|	After user has been authenticated, his role is checked to see "admin" or "user"
	|	If "admin", he will be directed to Users Management Page. Eitherwise, to user's dashboard.
	|
	*/
	public function postLogin() {
		$credentials = array(
			'email' => Input::get('inputEmail'),
			'password' => Input::get('inputPassword')
		);

		if( Auth::attempt($credentials)) {
			
			$email = Input::get('inputEmail');
			$record = User::where('email', '=', $email)->firstOrFail();
			$role = $record->role;
			if($role == 'admin') {
				return Redirect::action('UserController@getIndex');
				//return 'admin';

			}
			//return 'user';
			return Redirect::intended('dashboard');
		}else{
			return View::make('home.index', 
			array(
				'hasMessage' => true, 
				'msgType' => 'danger', 
				'msgTitle' => 'Login Failed!', 
				'msgMessage' => 'Please try again'
			)
		);

		}

		
	}

	public function getLogout() {
		Auth::logout();
		return View::make('home.index');
	}

	public function getProfile() {
		return View::make('dashboard.userinfo.userinfo');
	}

	/*
	|
	| Return the form for creating user 
	| 
	|
	*/
	public function getNew() {
		return View::make('dashboard/userinfo/userform');
	}

	/*
	|
	| Create the user 
	| 
	|
	*/
	public function postNew() {
		// Validate the input
		$input = array(
			'name' => Input::get('inputName'),
			'email' => Input::get('inputEmail'),
			'password' => Hash::make(Input::get('inputPassword')),
			'role' => Input::get('inputRole')
		);

		$user = new User;
     	if ($user->validate($input))
        {
			// Update the user
            $user = User::create($input);

            // If there were errors in creating the user, return the current page with error message
            if(!$user) {
            	return Redirect::action('UserController@getEdit', array('id'=>$user->id, 'type' => 'error'));
            }			
        }
        else
        {        	
        	// There are errors in validating the input.
        	$error = $user->errors();
		    return View::make('dashboard.userinfo.userForm', array('user' => $user), array(
				'hasMessage' => true, 
				'msgType' => 'danger', 
				'msgTitle' => 'Validation Error : ', 
				'msgMessage' => $error->first('name'). " " . $error->first('email')
			));
        }

		// If you reached this far, everything is ok and return to current page with the success message
		return Redirect::action('UserController@getEdit', array('id' => $user->id, 'type' => 'save'));	
	}

	/*
	|
	| Return the form for editing the user
	| 
	|
	*/
	public function getEdit($id, $type = null) {
		switch ($type) {
			case 'save':
					$msg = array(
					'hasMessage' => true, 
					'msgType' => 'success', 
					'msgTitle' => 'Success!', 
					'msgMessage' => 'User has been successfully created'
				);
				break;
			case 'update':
					$msg = array(
					'hasMessage' => true, 
					'msgType' => 'success', 
					'msgTitle' => 'Success!', 
					'msgMessage' => 'User has been successfully updated'
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

		// Get the user record
		$user = User::find($id);
		// At form start, there will be no message to display
		if(is_null($type)) {
			return View::make('dashboard/userinfo/userForm', array('user' => $user));
		}
		else {
			return View::make('dashboard/userinfo/userForm', $msg, array('user' => $user));
		}		
	}

	/*
	|
	| Update the user with new data
	| 
	|
	*/
	public function postEdit($id) {
		// Get the existing user by Id
		$currentUser = User::find($id);

		// Create new user object
		$user = new User;

		$user->rules["email"] = 'required|email|unique:users,email,' . $id; // Update validation rules. Ignore unique validation on update

		// Get the input
		if(Input::get('inputPassword') != "") {
			$input = array(
				'name' => Input::get('inputName'),
				'email' => Input::get('inputEmail'),
				'password' => Hash::make(Input::get('inputPassword')),
				'role' => Input::get('inputRole')
			);
		}
		else {
			$input = array(
				'name' => Input::get('inputName'),
				'email' => Input::get('inputEmail'),
				'role' => Input::get('inputRole')
			);
			$user->rules["password"] = ''; // To ignore the password
		}

		// Validate the input
     	if ($user->validate($input))
        {
			// Update the user
            $user = $currentUser->update($input);

            // If there were errors in updating the user, return the current page with error message
            if(!$user) {
            	return Redirect::action('UserController@getEdit', array('id'=>$id, 'type' => 'error'));
            }			
        }
        else
        {        	
        	// There are errors in validating the input.
        	$error = $user->errors();
		    return View::make('dashboard.userinfo.userForm', array('user' => $currentUser), array(
				'hasMessage' => true, 
				'msgType' => 'danger', 
				'msgTitle' => 'Validation Error : ', 
				'msgMessage' => $error->first('name'). " " . $error->first('email')
			));
        }

		// If you reached this far, everything is ok and return to current page with the success message
		return Redirect::action('UserController@getEdit', array('id' => $id, 'type' => 'update'));
	}

	public function getShow($id) {
		$user=User::find($id);

		// Get all profiles by user
		$profiles = $user->profiles()->paginate(5);

		// Get all songs by user
		$songs = $user->songs()->paginate(5);

		// Get the count of songs by profile
		$sng_count_prf = array();
		foreach ($user->profiles()->get() as $prf) {
			$sng_count = SongRoleProfile::where('profile_id', array($prf->id))->count();
			$sng_count_prf[$prf->id] = $sng_count;
		}		
		
		return View::make('dashboard.userinfo.userDetails', array(			
			'user' => $user,
			'profiles' => $profiles,
			'songs' => $songs,
			'sng_count_prf' => $sng_count_prf
			)
		);
	}

	public function postSearch() {
		$name = Request::get('inputSearchName');
		if(empty($name)){
			return $this->getIndex();
		}
		else{
			$users = User::where('name', 'LIKE', '%'. $name .'%')->get();
			return View::make('dashboard.userinfo.userList',array("users"=>$users,"keyword" => $name));
		}
	}
}