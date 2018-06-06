<?php

require_once __DIR__."/../init.php";

$sess->destroy();
setcookie("logged_in", null, null);
setcookie("tea_panel_session", null, null);
header("Location: /login.php?ref=logout&w=".urldecode(rstr(64)));
exit;
