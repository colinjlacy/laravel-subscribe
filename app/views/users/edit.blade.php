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
		{{ Form::model($user, array('method' => 'PATCH', 'url' => array('user/'.$user->id), 'id' => 'update-form')) }}

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
    	<h3>Your Billing Information:</h3>
    	<p class="text-muted"><em><strong>Note:</strong> since this is just a demo, this is not currently something that the user can update. Obviously that would change in production</em></p>
		<div class="well">
			<div class="form-group">
				<div class="row form-horizontal">
					{{ Form::label('last-four', 'Last Four:', array('class' => 'col-sm-2 control-label')) }}
					<div class="col-sm-10">
						<p class="form-control-static">...{{$user['last_four']}}</p>
					</div>
				</div>
				{{--{{ Form::text('cc', $user['last_four'], array('class' => 'form-control-static')) }}--}}
			</div>
			<div class="form-group">
				<div class="row form-horizontal">
					{{ Form::label('plan', 'Your Billing Plan:', array('class' => 'col-sm-2 control-label')) }}
					<div class="col-sm-10">
						<p class="form-control-static">{{$user['stripe_plan']}}</p>
					</div>
				</div>
			{{--{{ Form::text('cc', $user['stripe_plan'], array('class' => 'form-control-static')) }}--}}
			</div>
		</div>
		<hr/>
    	{{ Form::submit('Submit', array('class' => 'btn btn-primary')) }}

    	{{ Form::close() }}

    	{{--The botton below gives the user the option to delete their account--}}
		<hr/>
		<p class="text-muted">Would you like to delete your account from our site?</p>
		<form method="POST" action="http://laravel.site:8000/user/{{Auth::id()}}" accept-charset="UTF-8">
			<input name="_method" type="hidden" value="DELETE"><input name="_token" type="hidden" value="x3YwmsZkkihBHe7ZsMxqmmO4FZtc1r9xnPtWj9QN">
			<input class="btn btn-danger" type="submit" value="Delete">
		</form>

@stop