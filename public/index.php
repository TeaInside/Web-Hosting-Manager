<?php
require __DIR__ . "/../init.php";
if (isLoggedIn())
	require __DIR__ . "/home.php";
 else 
	require __DIR__ . "/login.php";
