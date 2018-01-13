<?php
require __DIR__ . "/../init.php";
if (! isLoggedIn()) {
	redirect("login.php?ref=home&w=".urlencode(rstr(64))."&".continueablePage());
}

$a = Container::gi();

if ($a['username'] === "root") {
	view('home/root', ["a" => $a]);
} else {
	view('home/user', ["a" => $a]);
}