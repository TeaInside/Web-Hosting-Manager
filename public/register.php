<?php
require __DIR__ . "/../init.php";
if (isLoggedIn()) {
	redirect("home.php?ref=register&w=".urlencode(rstr(64)));
}

if (isset($_GET['action'], $_GET['w']) && $_SERVER['REQUEST_METHOD'] === "POST") {
	function send($msg, $red = null, $w = null)
	{
		print json_encode([
			"message" => $msg,
			"redirect" => $red,
			"w" => $w
		]);
		die;
	}
	header("Content-type:application/json");
	$a = json_decode(file_get_contents("php://input"), true);
	if (isset($a['full_name'], $a['email'], $a['address'], $a['phone'], $a['username'], $a['password'], $a['cpassword'])) {
		if (! filter_var($a['email'], FILTER_VALIDATE_EMAIL)) {
			send("Invalid email!");
		}

		if (strlen($a['address']) < 10) {
			send("Address is too short, please provide real address!");
		}

		$a['phone'] = str_replace("+62", "0", $a['phone']);
		if (! preg_match('/(^0\d{2})\d{4,20}/', $a['phone']) || preg_match('/[^\d]/', $a['phone'])) {
			send("Invalid phone number!");
		}
	}
	exit(0);
}
?><!DOCTYPE html>
<html>
<head>
	<title>Register</title>
	<script type="text/javascript" src="js/register.js"></script>
	<style type="text/css">
		.main-cage {
			margin-top: 40px;
			border: 1px solid #000;
			padding-top: 20px;
			width: 430px;
			height: 400px;
		}
		button {
			margin-top: 18px;
			cursor: pointer;
		}
	</style>
</head>
<body>
<center>
	<div class="main-cage">
		<form method="post" action="javascript:void(0);" id="form">
			<table>
				<thead>
					<tr><th colspan="3" align="center">Enter your information</th></tr>
				</thead>
				<tbody>
					<tr><td>Full Name</td><td>:</td><td><input required  type="text" id="full_name"></td></tr>
					<tr><td>E-Mail</td><td>:</td><td><input required  type="email" id="email"></td></tr>
					<tr><td>Address</td><td>:</td><td><textarea required id="address" style="width:165px;height:69px;resize:none;"></textarea></td></tr>
					<tr><td>Phone Number</td><td>:</td><td><input required  type="text" id="phone"></td></tr>
					<tr><td><div style="padding-bottom:10px;"></div></td></tr>
				</tbody>
				<thead>
					<tr><th colspan="3" align="center">Create Your Account</th></tr>
				</thead>
				<tbody>
					<tr><td>Username</td><td>:</td><td><input required  type="text" id="username"></td></tr>
					<tr><td>Password</td><td>:</td><td><input required  type="password" id="password"></td></tr>
					<tr><td>Confirm Password</td><td>:</td><td><input required  type="password" id="cpassword"></td></tr>
				</tbody>
				<tfoot>
					<tr><th colspan="3" align="center"><button type="submit" name="submit">Submit</button></th></tr>
				</tfoot>
			</table>
		</form>
	</div>
</center>
<script type="text/javascript">
	var ch = new register("?action=1&has_verified_account=false&w=<?php print htmlspecialchars(urlencode(rstr(64))); ?>");
		ch.listen();
</script>
</body>
</html>