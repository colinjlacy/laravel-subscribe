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
			'name'		=> 'Edward Lacy',
			'username'	=> 'Mushigats',
			'email'		=> 'ed@lacy.com',
			'password'	=> Hash::make('a'),
			'role'		=> 1
	));
		User::create(array(
			'name'		=> 'Ashley Lacy',
			'username'	=> 'ashley',
			'email'		=> 'ashley@lacy.com',
			'password'	=> Hash::make('a'),
			'role'		=> 1
		));
		User::create(array(
			'name'		=> 'Kathy Lacy',
			'username'	=> 'kml',
			'email'		=> 'km@lacy.com',
			'password'	=> Hash::make('a'),
			'role'		=> 1
		));
		User::create(array(
			'name'		=> 'Colin Lacy',
			'username'	=> 'colinjlacy',
			'email'		=> 'colin@lacy.com',
			'password'	=> Hash::make('a'),
			'role'		=> 9
		));
	}
}