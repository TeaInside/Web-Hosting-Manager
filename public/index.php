<?php

require __DIR__ . "/../init.php";

if (Session::get('login')) {
	
}

// Session::destroy();

Session::set("","");

// var_dump(Session::getAll());

var_dump($_COOKIE[SESSION_COOKIE_NAME]);