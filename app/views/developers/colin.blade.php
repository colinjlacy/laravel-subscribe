@section('heading')
	<section>
		<h1>Welcome to the User Billing Demo</h1>
		<p class="lead">This demo shows a user flow from initial arrival, through registration and billing sign-up, and into user access for protected pages.</p>
	</section>
	<aside>
		<p>Want to Log In?</p>
		<a class="btn btn-primary" href="/user/">Log In!</a>
	</aside>

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

@stop

