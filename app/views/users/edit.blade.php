@section('heading')
	<h1>{{$user['name']}}</h1>
	<p>
		@if($user['role'] == 9)
			An Administrator
		@else
			A General User
		@endif
	</p>
@stop

@section('content')
	<h2>Use the form below to update this user's information:</h2>
		{{--Note that I had to use a hard URL here; I couldn't get a named route to work--}}
		{{ Form::model($user, array('method' => 'PATCH', 'url' => array('user/'.$user->id), 'id' => 'payment-form')) }}

		<div id="payment-errors"></div>

    	<div class="form-group @if ($errors->has('name')) has-error @endif">
    	{{ Form::label('name', 'Name', array('class' => 'control-label', 'id' => 'payment-form')) }}
    	{{ Form::text('name', $user['name'], array('class' => 'form-control', 'value' => Input::old('name'))) }}
    	@if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
    	</div>
    	<div class="form-group @if ($errors->has('username')) has-error @endif">
    	{{ Form::label('username', 'User Name', array('class' => 'control-label')) }}
    	{{ Form::text('username', $user['username'], array('class' => 'form-control', 'value' => Input::old('username'))) }}
    	@if ($errors->has('username')) <p class="help-block">{{ $errors->first('username') }}</p> @endif
    	</div>
    	<div class="form-group @if ($errors->has('email')) has-error @endif">
    	{{ Form::label('email', 'Email Address', array('class' => 'control-label')) }}
    	{{ Form::email('email', $user['email'], array('class' => 'form-control', 'value' => Input::old('email'))) }}
    	@if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p> @endif
    	</div>
    	<div class="form-group @if ($errors->has('email_conf')) has-error @endif">
    	{{ Form::label('email_conf', 'Confirm your Email Address', array('class' => 'control-label')) }}
    	{{ Form::email('email_conf', $user['email'], array('class' => 'form-control', 'value' => Input::old('email_conf'))) }}
    	@if ($errors->has('email_conf')) <p class="help-block">{{ $errors->first('email_conf') }}</p> @endif
    	</div>
    	<hr/>
    	<p>Enter a new password, or leave blank to keep the current password.</p>
    	<div class="form-group @if ($errors->has('password')) has-error @endif">
    	{{ Form::label('password', 'Enter a Password', array('class' => 'control-label')) }}
    	{{ Form::password('password', array('class' => 'form-control')) }}
    	@if ($errors->has('password')) <p class="help-block">{{ $errors->first('password') }}</p> @endif
    	</div>
    	<div class="form-group @if ($errors->has('password_conf')) has-error @endif">
    	{{ Form::label('password_conf', 'Confirm your Password', array('class' => 'control-label')) }}
    	{{ Form::password('password_conf', array('class' => 'form-control')) }}
    	@if ($errors->has('password_conf')) <p class="help-block">{{ $errors->first('password_conf') }}</p> @endif
    	</div>
    	<hr/>
    	<h3>Sign up for Billing!</h3>
		<div class="form-group @if ($errors->has('cc')) has-error @endif">
		{{ Form::label('cc', 'Credit Card Number', array('class' => 'control-label')) }}
		{{ Form::text('cc', "4242424242424242", array('class' => 'form-control card-number')) }}
		@if ($errors->has('cc')) <p class="help-block">{{ $errors->first('cc') }}</p> @endif
		</div>
		<div class="form-group @if ($errors->has('cvc')) has-error @endif">
		{{ Form::label('cvc', 'CVC', array('class' => 'control-label')) }}
		{{ Form::text('cvc', "123", array('class' => 'form-control card-cvc')) }}
		@if ($errors->has('cvc')) <p class="help-block">{{ $errors->first('cvc') }}</p> @endif
		</div>
		<div class="form-group @if ($errors->has('expm')) has-error @endif">
		{{ Form::label('expm', 'Expiration Month', array('class' => 'control-label')) }}
		{{ Form::text('expm', "12", array('class' => 'form-control card-expiry-month')) }}
		@if ($errors->has('expm')) <p class="help-block">{{ $errors->first('expm') }}</p> @endif
		</div>
		<div class="form-group @if ($errors->has('expy')) has-error @endif">
		{{ Form::label('expy', 'Expiration Year', array('class' => 'control-label')) }}
		{{ Form::text('expy', "2015", array('class' => 'form-control card-expiry-year')) }}
		@if ($errors->has('expy')) <p class="help-block">{{ $errors->first('expy') }}</p> @endif
		</div>
    	{{ Form::submit('Submit', array('class' => 'btn btn-primary')) }}

    	{{ Form::close() }}
@stop