<?php
/**
 * Created by PhpStorm.
 * User: colinjlacy
 * Date: 9/23/14
 * Time: 12:43 PM
 */

class UserTableSeeder extends Seeder
{
	public function run()
	{
		User::create(array(
			'name'		=> 'Admin Istrator',
			'username'	=> 'admin',
			'email'		=> 'admin@istrator.com',
			'password'	=> Hash::make('a'),
			'role'		=> 9
		));
	}
}