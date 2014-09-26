@section('heading')
	<h1>Nicely done!</h1>
	<p>You've successfull updated the account for {{$user['name']}}</p>
@stop

<?php
$user_roles = array(
	1 => 'General Subscriber',
	9 => 'Admin'
);

$this_role = $user['role'];
?>

@section('content')
	<p class="lead">Other information about {{$user['name']}}:</p>
	<p>
		<strong>Username:</strong> {{$user['username']}}
	</p>
	<p>
		<strong>Email:</strong> {{$user['email']}}
	</p>
	<p>
		<strong>Role:</strong> {{$user_roles[$user['role']]}}
	</p>
	<hr/>
	@if (null == $user['stripe_id'])
		<h3>This user has not signed up for Billing.</h3>
	@else
		<h3>This user's Stripe Information</h3>
		<p>
			<strong>Stripe ID:</strong> {{$user['stripe_id']}}
		</p>
		<p>
			<strong>Stripe Plan:</strong> {{$user['stripe_plan']}}
		</p>
		<p>
			<strong>Last Four:</strong> {{$user['last_four']}}
		</p>
	@endif
@stop