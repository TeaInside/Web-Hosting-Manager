<?php

if (! defined("INIT")) {
	define("INIT", 1);

	require __DIR__."/config/config.php";
	require __DIR__."/isolated_files/helpers.php";

	function teaAutoloader($className)
	{
		$className = str_replace("\\", "/", $className);
		if (file_exists($f = __DIR__."/isolated_files/classes/{$className}.php")) {
			require $f;
		}
	}

	spl_autoload_register("teaAutoloader");

	

	if (isset($_COOKIE["tea_panel_session"])) {
		$sess = session(decrypt($_COOKIE["tea_panel_session"], APP_KEY));
	} else {
		setcookie("tea_panel_session", encrypt($sessId = rstr(32), APP_KEY), time()+(3600*24), "/");
		$sess = session($sessId);
	}

}