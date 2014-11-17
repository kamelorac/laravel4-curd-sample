<?php
namespace Models;
use Models\User;
use Validator;

class Post extends \Eloquent {
	protected $table = 'posts';
	protected $fillable = ['user_id','title'];
	public $rules = array(
		'user_id' => 'required|integer',
		'title' => 'required|min:3'
	);

	private $errors;
  
	public function user() {
		 return $this->belongsTo('Models\\User');
	}

	public function validate($data) {
        // make a new validator object
        $validation = Validator::make($data, $this->rules);

        // check for failure
        if ($validation->fails()) {
            // set errors and return false
            $this->errors = $validation->messages();
            return false;
        }

        // validation pass
        return true;
    }

    public function errors() {
        return $this->errors;
    }
}