<!DOCTYPE html>
<html>
<head>
	<title>Welcome {{ $name }}!</title>
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/clientarea.css') }}">
</head>
<body>
<center>
	<h1>Tea Panel</h1>
	<div class="nav">
		<a href="{{ route('logout') }}"><button type="button" class="button">Logout</button></a>
	</div>
	<div class="menu">
		<a href="{{ route('elfinder') }}">
			<div class="submenu">
				<p>elFinder</p>
			</div>
		</a>
		<a href="">
		<div class="submenu">
			<p>Adminer</p>
		</div>
		</a>
		<a href="">
		<div class="submenu">
			<p>Domain Management</p>
		</div>
		</a>
	</div>
</center>
</body>
</html>