<?php

if (! defined("INIT")) {
	define("INIT", microtime(true));

	session_start([
   	 'cookie_lifetime' => 86400,
	]);

	require __DIR__ . "/config.php";
	require __DIR__ . "/classes/helpers.php";
	function __class_loader($class)
	{
		require __DIR__ . "/classes/" . str_replace("\\", "/", $class) . ".php";
	}
	spl_autoload_register('__class_loader');
	$scan = scandir(__DIR__ . "/functions");
	unset($scan[0], $scan[1]);
	foreach ($scan as $key => $value) {
		require __DIR__ . "/functions/{$value}";
	}
}