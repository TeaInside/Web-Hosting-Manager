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

function makeConfig($username, $domain, $docroot, $logs)
{
	$a = str_replace(
			[
				"{{domain}}",
				"{{document_root}}",
				"{{logs}}"
			],
			[
				$domain,
				$docroot,
				$logs
			],
			file_get_contents(basepath."/isolated_files/domain80.stub")
	);
	$a = file_put_contents($file = sites_available."/".$username."_".$domain.".conf", $a);
	$file = realpath($file);
	shell_exec("sudo ln -s $file /etc/apache2/sites-enabled/".$username."_".$domain.".conf");
}

function reloadPath($username, $path)
{
	foreach ($path as $value) {
		if (! is_dir($path)) {
			shell_exec("sudo rm -rf ".$path);
			shell_exec("sudo mkdir -p ".$path);
		}
		shell_exec("sudo chmod -R 777 ".$path);
		shell_exec("sudo chown -R {$username}:{$username} ".$path);
	}
}

$a = Container::gi();
if (isset($_GET['reload'])) {
	if (isset($a['domains'][$_GET['reload']])) {
		reloadPath($a['username'], 
			[
				$a['domains'][$_GET['reload']]['document_root'], 
				$a['domains'][$_GET['reload']]['logs']
			]
		);
		makeConfig(
			$a['username'], 
			$_GET['reload'], $a['domains'][$_GET['reload']]['document_root'], 
			$a['domains'][$_GET['reload']]['logs']
		);
		?><script type="text/javascript">alert('<?php print $_GET['reload'];?> was being reloaded!\n<?php print "\\n".shell_exec("sudo service apache2 reload 2>&1"); ?>');window.location='?'</script><?php
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