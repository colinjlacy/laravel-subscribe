@section('heading')
	<h1>Are you sure?</h1>
	<p>This cannot be undone.</p>
@stop

@section('content')
	<p class="lead">By clicking the button below, you will delete the user <strong>{{$user['name']}}</strong> from the database.</p>
@stop
