@section('heading')
	<h1>This is a login form</h1>
	<p>It eats usernames and passwords.</p>
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



	{{ Form::open(array('url' => '/user/login')) }}

	<div class="form-group @if ($errors->has('username')) has-error @endif">
	{{ Form::label('username', 'User Name', array('class' => 'control-label')) }}
	{{ Form::text('username', "", array('class' => 'form-control', 'value' => Input::old('username'))) }}
	@if ($errors->has('username')) <p class="help-block">{{ $errors->first('username') }}</p> @endif
	</div>
	<div class="form-group @if ($errors->has('password')) has-error @endif">
	{{ Form::label('password', 'Enter a Password', array('class' => 'control-label')) }}
	{{ Form::password('password', array('class' => 'form-control')) }}
	@if ($errors->has('password')) <p class="help-block">{{ $errors->first('password') }}</p> @endif
	</div>
	{{ Form::submit('Submit', array('class' => 'btn btn-primary')) }}

	{{ Form::close() }}

	<hr/>

	New User? <a href="{{URL::route('user.create')}}">Register Now!</a>



@stop