<!DOCTYPE html>
<html>
<head>
	<title>Login TeaPanel</title>
	<script type="text/javascript" src="{{ asset('assets/js/utils/dom.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/js/auth/login.js') }}"></script>
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/login.css') }}">
</head>
<body>
	<div class="login-page">
		<div class="form">
			<h1>Login</h1>
			<form class="login-form" action="?action=1" method="post" id="form">
				<input type="text" name="username" placeholder="Username" id="username">
				<input type="password" name="password" placeholder="Password" id="password">
				<button type="submit" name="login">Login</button>
			</form>
	  	</div>
	</div>
	<script type="text/javascript">
		var ch = new login("{{ route('login_action') }}");
			ch.listen();
	</script>
</body>
</html>