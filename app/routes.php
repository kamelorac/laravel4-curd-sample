<?php
/*
|--------------------------------------------------------------------------
| WebService Resource Routes 
|--------------------------------------------------------------------------
*/

Route::group(array('prefix' => 'api'), function() {
    Route::resource('users', 'Controllers\\API\\UsersController');
    // Route::resource('posts', 'Controllers\\API\\PostController');
});



/*
|--------------------------------------------------------------------------
| Application Routes // Can't access without authentication added
|--------------------------------------------------------------------------
*/


Route::group(array('before' => 'auth'), function() {
    Route::controllers(
        array(
            'dashboard' => 'DashboardController',
            'post' => 'PostController'
        )
    );
});


Route::get('/', function()
{
	return View::make('home.index');
});

Route::controllers( array('user' => 'UserController'));
