<?php

function rstr($n = 32, $chars = "1234567890qwertyuiopasdfghjkklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM____")
{
	$result    = "";
	$maxlength = strlen($chars) - 1;
	for ($i=0; $i < $n; $i++) { 
		$result .= $chars[rand(0, $maxlength)];
	}
	return $result;
}


function redirect($to = "")
{
	header("location: {$to}");
	exit(0);
}

function view($file, $__variables)
{
	foreach ($__variables as $__key => $__value) {
		$$__key = $__value;
	}
	unset($__variables, $__key, $__value);
	return require BASEPATH."/isolated_views/".$file.".php";
}

function continueablePage()
{
	return "continue=".urlencode(rawurlencode(APP_HOST.$_SERVER['REQUEST_URI'].$query));
}