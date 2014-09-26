@section('heading')
	<h1>Welcome {{$name}}!</h1>
	<p>You are, in fact, a rock star.</p>
@stop

@section('content')
	<p>We've created a sweet profile for you on our site under the username <em>{{$username}}</em>.  You should get an email at <strong>{{$email}}</strong> proving that we're telling the truth and not lying bastards.</p>
	<p class="text-primary">Not done yet?</p>
	<a class="btn btn-primary" href="http://laravel.site:8000/user/create">Add another User!</a>
@stop
