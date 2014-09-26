<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

//Route::get('/', function()
//{
//	$view = View::make('hello');
//	return $view;
//});

$user_route = 'user';
//$user_model = 'User';
$user_ctrl = 'UserController';



Route::get('/', array('as' => 'home', 'uses' => 'HomeController@newWelcome'));

// The base resource definition for user registration
Route::resource($user_route, $user_ctrl);
//Route::model($user_route, $user_model);

	// Two additional route definitions for processing login form submissions, and the logout action
	Route::post('/user/login', $user_ctrl.'@processLogin');
	Route::any('/user/logout/', array('as' => 'logout', 'uses' => $user_ctrl.'@logout'));

// Route for a protected page
Route::any('protected', array('as' => 'protected', 'uses' => 'ProtectedController@index'));

// Route for a admin page
Route::resource('admin', 'AdminController');