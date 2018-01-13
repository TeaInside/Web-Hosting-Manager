<?php
require __DIR__."/../../init.php";
if (isLoggedIn()) {
	view('adminer');
} else {
	redirect("../index.php?ref=adminer&".continueablePage());
}