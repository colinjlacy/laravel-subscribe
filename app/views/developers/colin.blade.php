@section('content')
	<section>
		<h2>I am Colin!</h2>
		<p class="lead">I am a destroyer of cakes, both large and small. I am revered for my knowledge of ice cream, and am praised by those who wish to have it listed as a primary food group.</p>
	</section>
	<aside>
		<p>Want to Log In?</p>
		<a class="btn btn-primary" href="/user/">Log In!</a>
	</aside>
@stop


@section('heading')
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

	<section>
		<h1>Localhost!</h1>
		<p>This is where egos come to flex.</p>
	</section>
@stop

