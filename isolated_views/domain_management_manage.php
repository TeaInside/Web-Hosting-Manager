<?php

function domainManage($a)
{

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
		file_put_contents($file = realpath(sites_available."/".$username."_".$domain.".conf"), $a);
		shell_exec("sudo ln -s $file /etc/apache2/sites-enabled/".$username."_".$domain.".conf");
	}

	if (isset($_GET['action'], $_POST['domain'], $_POST['document_root'], $_POST['logs'])) {
		$_POST['domain'] = strtolower($_POST['domain']);
		$len = strlen($_POST['domain']);

		if (preg_match('/[^a-zA-Z\.\-]/', $_POST['domain']) || preg_match('/[^a-zA-Z]/', $_POST['domain'][$len - 1])) {
			return "Invalid domain ".$_POST['domain']."!";
		}
		$map = json_decode(file_get_contents(sites_available."/map"));
		$map = is_array($map) ? $map : [];
		$offset = array_search($_POST['domain'], $map);
		if ($_POST['domain'] !== $_GET['manage']) {
			if ($offset !== false) {
				return "Domain ".$_POST['domain']." is already exists in our system!";
			}
		}
		if (substr($_POST['document_root'], 0, $len = strlen($a['chroot'])) !== $a['chroot']) {
			return "Document root must be start with ".$a['chroot'];
		}
		if (substr($_POST['logs'], 0, $len = strlen($a['chroot'])) !== $a['chroot']) {
			return "Logs must be start with ".$a['chroot'];
		}
		
		if (! is_dir($_POST['document_root'])) {
			shell_exec("sudo rm -rf ".$_POST['document_root']);
			shell_exec("sudo mkdir -p ".$_POST['document_root']);
		}
		
		if (! is_dir($_POST['logs'])) {
			shell_exec("sudo rm -rf ".$_POST['logs']);
			shell_exec("sudo mkdir -p ".$_POST['logs']);	
		}

		makeConfig($a['username'], $_POST['domain'], $_POST['document_root'], $_POST['logs']);
	}
}

$alert = domainManage($a);
?>
<!DOCTYPE html>
<html>
<head>
<?php if (isset($alert)): ?>
	<script type="text/javascript">alert('<?php print $alert; ?>');</script>
<?php endif ?>
	<title><?php print $_GET['manage']; ?></title>
	<link rel="stylesheet" type="text/css" href="../css/domain_management_manage.css">
</head>
<body>
	<center>
		<div class="main">
			<div class="navbar">
				<a href="?ref=manage&amp;w=<?php print urlencode(rstr(64)); ?>"><button>Back to Domain Management</button></a>
			</div>
			<form method="post" action="?action=1&amp;manage=<?php print urlencode($_GET['manage']); ?>">
				<table>
					<tr><td>Domain</td><td>:</td><td><input type="text" name="domain" value="<?php print htmlspecialchars($_GET['manage']); ?>" size="45"></td></tr>
					<tr><td>Document Root</td><td>:</td><td><input type="text" name="document_root" value="<?php print htmlspecialchars($a['domains'][$_GET['manage']]['document_root']); ?>" size="45"></td></tr>
					<tr><td>Logs</td><td>:</td><td><input type="text" name="logs" value="<?php print htmlspecialchars($a['domains'][$_GET['manage']]['logs']); ?>" size="45"></td></tr>
					<tr><td colspan="3" align="center"><button>Save</button></td></tr>
				</table>
			</form>
		</div>
	</center>
</body>
</html>