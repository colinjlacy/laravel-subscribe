@section('heading')
	<h1>You are truly an Admin!</h1>
	<p>From here you can do all the things.</p>
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

	<h2>Here are all of the Users on your site:</h2>
	@if (count($users) >= 1)
		<table class="table-bordered table">
			<thead>
				<tr>
					<td>Name</td>
					<td>Email</td>
					<td>Role</td>
					<td>Plan</td>
					<td>Edit</td>
					<td>Delete</td>
				</tr>
			</thead>
			<tbody>
				@foreach($users as $user)
					<tr>
						<td>{{$user['name']}}</td>
						<td>{{$user['email']}}</td>
						<td class="text-center">{{$user['role']}}</td>
						<td class="text-center">{{$user['stripe_plan']}}</td>
						<td class="text-center"><a class="btn btn-sm btn-primary" href="/user/{{$user['id']}}/edit">Edit</a></td>
						<td class="text-center">
						{{ Form::model($user, array('method' => 'DELETE', 'url' => array('user/'.$user->id))) }}
							<input type="submit" class="btn btn-danger @if ($user['role'] == 9) disabled @endif" value="Delete"/>
						{{ Form::close() }}
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	@else
		<p class="lead">Nobody wants to play with me :(</p>
	@endif
@stop