<?php

require_once __DIR__."/../init.php";

if (! isset($sess["login"])) {
	header("Location: /login.php?ref=home&w=".urldecode(rstr(64)));
	exit;
}

$a = u($sess["user"]);

if (isset($a["role"])) {
	switch ($a["role"]) {
		case 'superuser':
			view("home_superuser", ["a" => $a]);
			break;
		
		default:
			
			break;
	}
}