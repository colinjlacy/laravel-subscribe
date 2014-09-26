<html>
<head>
	<title>This is my Laravel App</title>

	<!--Styles-->
	<link rel="stylesheet" href="/css/bootstrap.min.css"/>
	<link rel="stylesheet" href="/css/bootstrap-theme.min.css"/>

</head>

<body>

<header class="jumbotron">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h1>You've made a terrible mistake</h1>
			</div>
		</div>
	</div>
</header>

<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<p class="lead">Error: 404</p>
			<p>The page you're looking for doesn't exist: <strong>{{$url}}</strong></p>
		</div>
	</div>
</div>

	<script src="/js/bootstrap.min.js"></script>
</body>
</html>