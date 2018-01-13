<?php
require __DIR__."/../../init.php";
if (! isLoggedIn()) {
	redirect("../index.php?ref=elfinder&".continueablePage());
}

function domainNotFound($domain)
{
	http_response_code(400);
	?><script type="text/javascript">alert('Domain <?php print $domain; ?> does not exists!');window.location='?'</script><?php
	die;
}

$a = Container::gi();
if (isset($_GET['reload'])) {
	if (isset($a['domains'][$_GET['reload']])) {
		?><script type="text/javascript">alert('<?php print $_GET['reload']; ?> was being reloaded!');window.location='?'</script><?php
	} else {
		domainNotFound($_GET['reload']);
	}
	exit(0);
} elseif (isset($_GET['manage'])) {
	if (isset($a['domains'][$_GET['manage']])) {
		view("domain_management_manage", ["a" => $a]);
	} else {
		domainNotFound($_GET['manage']);
	}
	die;
}


view('domain_management', ["a" => $a]);