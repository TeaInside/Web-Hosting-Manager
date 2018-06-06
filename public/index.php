<?php

require __DIR__."/../init.php";

if (isset($sess["login"])) {
	require __DIR__."/home.php";
} else {
	require __DIR__."/login.php";
}
