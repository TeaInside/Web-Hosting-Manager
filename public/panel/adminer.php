<?php
require __DIR__."/../../init.php";
if (isLoggedIn()) {
	view('adminer');
} else {
	$query = count($_GET) ? "?".http_build_query($_GET) : "";
	redirect("../index.php?ref=adminer&".continueablePage());
}