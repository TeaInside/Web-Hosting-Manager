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