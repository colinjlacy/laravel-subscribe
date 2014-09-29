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
@stop