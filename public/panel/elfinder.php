<?php
require __DIR__."/../../init.php";
if (isLoggedIn()) {
	view('elfinder');
} else {
	redirect("../index.php?ref=elfinder&".continueablePage());
}