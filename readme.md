##Laravel Subscribe##

This is my first foray into Laravel, a simple user authentication system that utilizes the Stripe Billing API that's built into Laravel to add subscriptions to user accounts.  Users can create accounts with or without signing up for Billing.

The app also features the ability to create Admin accounts, which have access to account editing and deletion.

###Installation###

For this project, you'll need a [Stripe](https://stripe.com/, "Stripe") key, both private and test.  So best to set those up before moving on to the installation.  You'll also need to create a billing plan called "laravel1".

This is meant to run entirely on a vagrant box, set up with Laravel's [Homestead](http://laravel.com/docs/4.2/homestead, "Homestead") environment.  There easiest way to get this demo up and running:
1. Create a Vagrant box running Homestead, as per the instructions in the link above.
2. Use Composer to install Laravel 4.2 by running the command `composer create-project laravel/laravel --prefer-dist`.
3. Open your `Homestead.yaml` file and map your Laravel project's parent directory path to the `~/Code` path.
4. Replace the `app/`, `boostrap/`, and `public/` directories in your Laravel project with the corresponding directories in this repository.
5. Add `"laravel/cashier": "~2.0"` to the `require` object in the `composer.json` file found in your Laravel project.
6. Run `composer install` or `composer update` to have Composer update your Laravel project with Cashier.  Once it's done, confirm that your project has the directory `vendor/laravel/cashier`.
7. Add your private key to the `stripe` array in `app/config/services.php`, and your public key to the `Stripe.setPublishableKey()` method in `public/js/main.js`.
8. `cd` to your Vagrant's root directory (the one with the `vagrantfile` and `homestead.yaml` files) and run the command `vagrant up`. Your Vagrant server should now be running.
9. SSH into vagrant from your Vagrant root directory by running the command `vagrant ssh`.  Then `cd` to your Laravel project, probably `cd Code/laravel`.
10. Migrate all of the necessary columns into your database by running the command `php artisan migrate`.
11. Last, seed the table with an admin account by running the command `php artisan db:seed`.

I'll work on shortening this list with some start commands in the future, and will also working on getting to a better hosting plan (HostGator no bueno) for my VPS so I can install Laravel and have a live working demo.

That's it!  Navigate to your project in your browser ([http://127.0.0.1:8000/](http://127.0.0.1:8000/) if you can't get the URL alias to work), and you should see the welcome screen.

This is a simple demo, so only the key functions are built in.  First of all, you can log in to the admin account by using the username `admin` with the password `a`.  That will display a table showing all users, and offers the ability to either edit or delete their info.

When you are logged out, you can register a new user by navigating to the login form, and clicking on the registration link.  The form is already pre-filled with Stripe's test credit card numbers.  Feel free to mess them up to test validation.  Once you submit the form with the correct info and all fields populated correctly, a user will be created and logged-in.  You can then access restricted pages and edit the user's info, or log out and do it all again.  Feel free to check into the admin account again from time to time to see how the user list updates.