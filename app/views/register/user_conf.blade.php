@section('heading')
	<h1>Welcome {{$name}}!</h1>
	<p>You are, in fact, a rock star.</p>
@stop

@section('content')
	<p class="lead">We've created a sweet profile for you on our site under the username <em>{{$username}}</em>.</p>
	<p class="text-primary">Continue on to the <strong>Private Pages</strong>.</p>
	<a href="{{URL::route('protected.index')}}" class="btn btn-primary">Continue</a>
@stop
