<?php
require __DIR__."/../../init.php";
if (isLoggedIn()) {
	$a = Container::gi();
	require __DIR__ . "/../../isolated_files/elFinder/php/connector.minimal.php";
} else {
	redirect("../index.php?ref=elfinder&".continueablePage());
}
