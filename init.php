<?php

if (! defined("INIT")) {
	define("INIT", time());
	require __DIR__ . "/config.php";
	require __DIR__ . "/classes/helpers.php";
	function __class_loader($class)
	{
		require __DIR__ . "/classes/" . str_replace("\\", "/", $class) . ".php";
	}
	spl_autoload_register('__class_loader');
}