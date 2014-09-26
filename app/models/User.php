<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;
use Laravel\Cashier\BillableTrait;
use Laravel\Cashier\BillableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface, BillableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $guarded = array('id', 'password');

	protected $hidden = array('password', 'remember_token');

	protected $fillable = array('name', 'email', 'password');

	// set some registration validation rules that we intend to apply
	public static $registrationRules = array(
		'name'			=> 'required',
		'username'		=> 'required',
		'email'			=> 'required|email|unique:users',
		'email_conf'	=> 'required|same:email',
		'password'		=> 'required',
		'password_conf'	=> 'required|same:password'
	);

	// set some login validation rules that we intend to apply
	public static $loginRules = array(
		'username'		=> 'required',
		'password'		=> 'required'
	);

	public static $updateRules = array(
		'name'			=> 'required',
		'username'		=> 'required',
		'email'			=> 'required|email', // NOTE THAT THIS HAS TO CHANGE - NEEDS A UNIQUE EMAIL VALUE
//		'email'			=> 'required|email|unique:users,',
		'email_conf'	=> 'required|same:email',
		'password_conf'	=> 'same:password'
	);

	use BillableTrait;

	protected $dates = ['trial_ends_at', 'subscription_ends_at'];

}
