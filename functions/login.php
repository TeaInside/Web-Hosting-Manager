<?php
function login($username, $password)
{
	$username = trim($username);
	if (file_exists($file = data."/users/{$username}")) {
		$file = json_decode($q = file_get_contents($file), true);
		if ($file['password'] === $password) {
			$_SESSION['login'] = 1;
			$_SESSION['user']  = $username;
			return true;
		}
	}
	return false;
}

function isLoggedIn()
{
	if (isset($_SESSION['login'], $_SESSION['user']) && file_exists(data."/users/{$_SESSION['user']}")) {
		Container::init($_SESSION['user']);
		return true;
	} else {
		$_SESSION['login'] = null;
	}
}
