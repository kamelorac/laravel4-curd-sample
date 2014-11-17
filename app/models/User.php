<?php
namespace Models;

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Validator;

class User extends \Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * These fields can be filled by mass assignment.
	 *
	 */
	protected $fillable = array('name', 'email', 'password','role');

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	/**
	 * Validation rule
	 *
	 */

	public $rules = array(
		'name' => 'required|min:3',
		'password' => 'required|min:8',
		'email' => 'required|email|unique:users'
	);
	
	private $errors;

	public function posts(){
		return $this->hasMany('Models\\Post');
	}

	public function validate($data)
    {
        // make a new validator object
        $validation = Validator::make($data, $this->rules);

        // check for failure
        if ($validation->fails())
        {
            // set errors and return false
            $this->errors = $validation->messages();
            return false;
        }

        // validation passed
        return true;
    }

    public function errors()
    {
        return $this->errors;
    }

}
