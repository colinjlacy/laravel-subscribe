<html>
<head>
	<title>This is my Laravel App</title>

	<!--Styles-->
	<link rel="stylesheet" href="/css/bootstrap.min.css"/>
	<link rel="stylesheet" href="/css/bootstrap-theme.min.css"/>

	<!--Scripts-->
	<script type="text/javascript" src="https://js.stripe.com/v2/"></script>

</head>

<body>
<header class="navbar navbar-default navbar-fixed-top" role="navigation">

	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
                    </div>
		<div class="navbar-collapse collapse">
			<ul id="menu-navigation-menu" class="nav navbar-nav navbar-right">
				<li><a href="/user">Login</a></li>
				@if (Auth::check())
				<li><a href="{{URL::route('user.edit', Auth::id())}}">Edit your Account</a></li>
				@endif
				@if (Auth::check() && Auth::user()->role == 9)
					<li><a href="{{URL::route('admin.index')}}">Admin Control</a></li>
				@endif
			</ul>
		</div><!--/.nav-collapse -->
	</div>

</header>
<header class="jumbotron">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				@yield('heading')
			</div>
		</div>
	</div>
</header>

<div class="container">
	<div class="row">
		<div class="col-sm-12">
            @yield('content')
		</div>
	</div>
</div>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="/js/bootstrap.min.js"></script>
	<script src="/js/plugins.js"></script>
	<script src="/js/main.js"></script>
</body>
</html>