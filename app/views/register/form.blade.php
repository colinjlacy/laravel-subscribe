@section('heading')
	<h1>This is a sample form</h1>
	<p>For all the people to see</p>
@stop

@section('content')
	@if ($errors->has())
		<div class="alert alert-danger">
			<ul>
			@foreach ($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
			</ul>
		</div>
	@endif

	{{ Form::open(array('route' => 'user.store', 'id' => 'payment-form')) }}

	<div id="payment-errors"></div>
	<div class="form-group @if ($errors->has('name')) has-error @endif">
	{{ Form::label('name', 'Name', array('class' => 'control-label')) }}
	{{ Form::text('name', "", array('class' => 'form-control', 'value' => Input::old('name'))) }}
	@if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
	</div>
	<div class="form-group @if ($errors->has('username')) has-error @endif">
	{{ Form::label('username', 'User Name', array('class' => 'control-label')) }}
	{{ Form::text('username', "", array('class' => 'form-control', 'value' => Input::old('username'))) }}
	@if ($errors->has('username')) <p class="help-block">{{ $errors->first('username') }}</p> @endif
	</div>
	<div class="form-group @if ($errors->has('email')) has-error @endif">
	{{ Form::label('email', 'Email Address', array('class' => 'control-label')) }}
	{{ Form::email('email', "", array('class' => 'form-control', 'value' => Input::old('email'))) }}
	@if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p> @endif
	</div>
	<div class="form-group @if ($errors->has('email_conf')) has-error @endif">
	{{ Form::label('email_conf', 'Confirm your Email Address', array('class' => 'control-label', 'value' => Input::old('email_conf'))) }}
	{{ Form::email('email_conf', "", array('class' => 'form-control')) }}
	@if ($errors->has('email_conf')) <p class="help-block">{{ $errors->first('email_conf') }}</p> @endif
	</div>
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
	<h3>Sign up for Billing:</h3>
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