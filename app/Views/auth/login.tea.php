<!DOCTYPE html>
<html>
<head>
	<title>Login TeaPanel</title>
	<script type="text/javascript" src="{{ asset('assets/js/utils/dom.js') }}"></script>
	<script type="text/javascript" src="{{ asset('assets/js/auth/login.js') }}"></script>
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/login.css') }}">
</head>
<body>
<center>
	<div class="form-cage">
		<div class="sub-cage head-form">
			<h1>Login Tea Panel</h1>
		</div>
		<form method="post" action="javascript:void(0);" id="form">
			<div class="sub-cage">
				<div>
					<label>Username: </label>
				</div>
				<div>
					<input type="text" name="username" id="username">
				</div>
			</div>
			<div class="sub-cage">
				<div>
					<label>Password: </label>
				</div>
				<div>
					<input type="password" name="password" id="password">
				</div>
			</div>
			<div class="sub-cage">
				<div>
					<button type="submit">Login</button>
				</div>
			</div>
		</form>
	</div>
</center>
<script type="text/javascript">
	var ch = new login("{{ route('login_action') }}");
		ch.listen();
</script>
</body>
</html>