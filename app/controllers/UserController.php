<?php

class UserController extends \BaseController {

	protected $layout = 'layouts.master';

	/**
	 * Display a listing of the resource, based on the GET method
	 *
	 * @return Response
	 */
	public function index()
	{
		if(Auth::guest()) {
			$this->layout->content = View::make('login.form');
		} else {
			return Redirect::to('/protected/');
		}
	}

	/**
	 * Processes the login form, based on the POST method
	 *
	 * @return Boolean
	 */
	public function processLogin()
	{
		// catch all the input into a stored variable
		$input = Input::all();

		// it's validation, baby!
		$validator = Validator::make($input, User::$loginRules);

		// check to see if the validator failed
		if ($validator->fails()) {

			// redirect the user back to the form
			return Redirect::to('user')
				->withErrors($validator)
				->withInput(Input::except('password'));

		} else {

			$user_data = array(
				'username'		=> Input::get('username'),
				'password'		=> Input::get('password')
			);

			// attempt to do the login
			if (Auth::attempt($user_data)) {

				// login is successful
				$user_role = Auth::user()->role;
//				return Redirect::route('user.show', array($user_id));
				if ($user_role == 9) {
					return Redirect::to('/admin/');
				} else {
					$user = Auth::user();
					return Redirect::to('/protected/')->with('user', $user);
				}

			} else {

				// authentication not successful
				return Redirect::to('user')
					->withErrors('Your username/password combination was incorrect.')
					->withInput();

			}

		}
	}

	/**
	 * POST action to log the user out
	 *
	 * @return mixed
	 */
	public function logout()
	{
		Auth::logout(); // logs the user out of the application
		return Redirect::route('user.index'); // redirects to the login screen
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$this->layout->content = View::make('register.form');
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		// catch all the input into a stored variable
		$input = Input::all();

		// it's validation, baby!
		$validator = Validator::make($input, User::$registrationRules);

		// check to see if the validator failed
		if ($validator->fails()) {

			// redirect the user back to the form
			return Redirect::route('user.create')
				->withErrors($validator)
				->withInput(Input::except('password', 'password_conf'));

		} else {

			// build the database data array for this user
			$user = new User;
			$user->name 				= $input['name'];
			$user->username 			= $input['username'];
			$user->email 				= $input['email'];
			$user->password 			= Hash::make($input['password']);
//			$user->stripe_active		= isset($input['stripe_active']) ? $input['stripe_active'] : 0;
//			$user->stripe_id			= isset($input['stripe_id']) ? $input['stripe_id'] : null;
//			$user->stripe_subscription	= isset($input['stripe_subscription']) ? $input['stripe_subscription'] : null;
//			$user->stripe_plan			= isset($input['stripe_plan']) ? $input['stripe_plan'] : null;
//			$user->last_four			= isset($input['last_four']) ? $input['last_four'] : null;

			// add the user to the database
			$user->save();

			// Log the user in
			Auth::login($user);

			// process the user's subscription
			if(null != Input::get( 'stripeToken' )) {
				$user->subscription('laravelplan1')->create( Input::get( 'stripeToken' ) );
			}

			// Output the view
			$this->layout->content = View::make('register.user_conf', array('name' => $user['name'], 'username' => $user['username'], 'email' => $user['email']));

		}

	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		echo "Why is this here?";
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{

		// get the curent user's role and ID
		$user_role = Auth::user()->role;
		$user_id = Auth::id();

		// get the data model of the user we're going to edit
		$user_to_edit = User::find($id);

		// if the current user is not an admin, and not the user in question
		if ($user_role != 9 && $user_id != $id) {
			return Redirect::to('/protected/');
		}

		// output the user edit form
		$this->layout->content = View::make('users.edit', array('user' => $user_to_edit));

	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		// get the curent user's role and ID
		$user_role = Auth::user()->role;
		$user_id = Auth::id();

		// if the current user is not an admin, and not the user in question
		if ($user_role != 9 && $user_id != $id) {
			return Redirect::to('/protected/');
		}

		// catch all the input into a stored variable
		$input = Input::all();

		// it's validation, baby!
		$validator = Validator::make($input, User::$updateRules);

		// check to see if the validator failed
		if ($validator->fails()) {

			// redirect the user back to the form
			return Redirect::to('user/'.$id.'/edit')
				->withErrors($validator)
				->withInput(Input::except('password', 'password_conf'));

		} else {

			// build the database data array for this user
			$user = User::find($id);
			if ($input['name'] != $user->name) {
				$user->name = $input['name'];
			}
			if ($input['username'] != $user->username) {
				$user->username = $input['username'];
			}
			if ($input['email'] != $user->email) {
				$user->email = $input['email'];
			}
			if(isset($input['password']) && $input['password'] != "") {
				$user->password 	= Hash::make($input['password']);
			}

			// update the user in the database
			$user->save();

			// Output the view
			$this->layout->content = View::make('users.updated', array('user' => $user));

		}
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{

		// if the user isn't logged in, send them back to the login screen with an error
		if (Auth::guest()) {
			return Redirect::to('user')
				->withErrors("You are not authorized for the action you've requested!");
		}

		// get the user model for the ID tha'ts been passed
		$user = User::find($id);

		// get info on the current user to see if they have permission to delete the user model
		$user_role = Auth::user()->role;
		$user_id = Auth::id();

		// if the current user's ID matches the ID of the user being deleted...
		if ($user_id == $id) {

			// we'll return them to the logout screen after we process the delete request
			$return = 'home';
			$deleted_user_message = "Your account";
			Auth::logout();

		// if the user is an admin
		} elseif ($user_role === 9) {

			// we'll return them to the admin screen after we process the delete request
			$return = 'admin.index';
			$deleted_user_message = "The account for ".$user['name'];

		// if the user is neither admin nor the user in question
		} else {

			// we'll return them to the main User screen with an error message immediately
			return Redirect::route('protected')
				->withErrors("You are not authorized for the action you've requested, weirdo");

		}

		User::destroy($id);

		return Redirect::route($return)->with('message', $deleted_user_message." has been successfully deleted");
	}


}
