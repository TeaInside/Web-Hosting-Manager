<?php
require __DIR__ . "/../init.php";
session_destroy();
redirect("index.php?ref=logout&w=".urlencode(rstr(64)));