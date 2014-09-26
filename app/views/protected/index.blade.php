@section('heading')
	<h1>Welcome, {{Auth::user()->name}} to the secret section</h1>
	<p>Where all the cool kids are these days.</p>
@stop


@section('content')
	@if (null !== Session::get('message'))
		<div class="alert alert-success">
			<p>{{Session::get('message')}}</p>
		</div>
	@endif

	@if ($errors->has())
		<div class="alert alert-danger">
			<ul>
			@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
			</ul>
		</div>
	@endif

	<p class="lead">If you're here, it means you've been logged in.</p>
	<p class="text-muted">I think that's super.</p>

	<?php
	$user = null !== Session::get('user') ? Session::get('user') : Auth::user(); ?>

	@if(null == $user['stripe_id'])
		<h3>Sign up for Billing because it's fun!</h3>
		{{ Form::model($user, array('method' => 'PATCH', 'url' => array('user/'.$user->id), 'id' => 'payment-form')) }}

		<div id="payment-errors"></div>

		<div class="form-group @if ($errors->has('')) has-error @endif">
		{{ Form::label('cc', 'Credit Card Number', array('class' => 'control-label')) }}
		{{ Form::text('cc', "4242424242424242", array('class' => 'form-control card-number')) }}
		@if ($errors->has('cc')) <p class="help-block">{{ $errors->first('cc') }}</p> @endif
		</div>
		<div class="form-group @if ($errors->has('username')) has-error @endif">
		{{ Form::label('cvc', 'CVC', array('class' => 'control-label')) }}
		{{ Form::text('cvc', "123", array('class' => 'form-control card-cvc')) }}
		@if ($errors->has('cvc')) <p class="help-block">{{ $errors->first('cvc') }}</p> @endif
		</div>
		<div class="form-group @if ($errors->has('email')) has-error @endif">
		{{ Form::label('expm', 'Expiration Month', array('class' => 'control-label')) }}
		{{ Form::text('expm', "12", array('class' => 'form-control card-expiry-month')) }}
		@if ($errors->has('expm')) <p class="help-block">{{ $errors->first('expm') }}</p> @endif
		</div>
		<div class="form-group @if ($errors->has('email_conf')) has-error @endif">
		{{ Form::label('expy', 'Expiration Year', array('class' => 'control-label')) }}
		{{ Form::text('expy', "2015", array('class' => 'form-control card-expiry-year')) }}
		@if ($errors->has('expy')) <p class="help-block">{{ $errors->first('expy') }}</p> @endif
		</div>
		{{ Form::submit('Submit', array('class' => 'btn btn-primary')) }}
		{{ Form::close() }}

	@endif

	<hr/>
	<form action="/user/logout/" method="POST">
		<input class="btn btn-warning" type="submit" value="Logout"/>
	</form>

	<form method="POST" action="http://laravel.site:8000/user/{{Auth::id()}}" accept-charset="UTF-8"><input name="_method" type="hidden" value="DELETE"><input name="_token" type="hidden" value="x3YwmsZkkihBHe7ZsMxqmmO4FZtc1r9xnPtWj9QN">
		<input class="btn btn-danger" type="submit" value="Delete">
	</form>

@stop