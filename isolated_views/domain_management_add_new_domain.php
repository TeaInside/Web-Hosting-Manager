<?php

function addNewDomain(&$a)
{
	$len = strlen($_POST['domain']);
	if ($len < 3 || preg_match('/[^a-zA-Z0-9]/', $_POST['domain'][0]) || preg_match('/[^a-zA-Z0-9\.\-]/', $_POST['domain']) || preg_match('/[^a-zA-Z0-9]/', $_POST['domain'][$len - 1])) {
		return "Invalid domain ".$_POST['domain']."!";
	}
	$_SESSION['domain'] = $_POST['domain'];
	$map = json_decode(file_get_contents(sites_available."/map"));
	$map = is_array($map) ? $map : [];
	$offset = array_search($_POST['domain'], $map);
	if ($offset !== false) {
		return "Domain ".$_POST['domain']." is already exists in our system!";
	}
	if (substr($_POST['document_root'], 0, $len = strlen($a['chroot'])) !== $a['chroot']) {
		return "Document root must be start with ".$a['chroot'];
	}
	$_SESSION['document_root'] = $_POST['document_root'];
	if (substr($_POST['logs'], 0, $len = strlen($a['chroot'])) !== $a['chroot']) {
		return "Logs must be start with ".$a['chroot'];
	}
	$_SESSION['logs'] = $_POST['logs'];
	if (! is_dir($_POST['document_root'])) {
		shell_exec("sudo rm -rf ".$_POST['document_root']);
		shell_exec("sudo mkdir -p ".$_POST['document_root']);
	}
	
	if (! is_dir($_POST['logs'])) {
		shell_exec("sudo rm -rf ".$_POST['logs']);
		shell_exec("sudo mkdir -p ".$_POST['logs']);	
	}
	makeConfig($a['username'], $_POST['domain'], $_POST['document_root'], $_POST['logs']);
	$a['domains'][$_POST['domain']] = [
		"document_root" => $_POST['document_root'],
		"logs" => $_POST['logs']
	];
	$map[] = $_POST['domain'];
	file_put_contents(sites_available."/map", json_encode($map, 128));
	reloadPath($a['username'],
		[
			$_POST['document_root'],
			$_POST['logs']
		]
	);
	unset($_SESSION['document_root'], $_SESSION['logs'], $_SESSION['domain']);
	$_SESSION['alert'] = "Domain ".$_POST['domain']." has been created successfully!";
	redirect("?ref=add_new_domain&w=".urlencode(rstr(64)));
}


if (isset($_GET['action'], $_POST['submit'], $_POST['domain'], $_POST['document_root'], $_POST['logs'])) {
	$_SESSION['alert'] = addNewDomain($a);
	redirect("");
}
?>
<!DOCTYPE html>
<html>
<head>
<?php if (isset($_SESSION['alert'])): ?>
	<script type="text/javascript">
		alert('<?php print $_SESSION['alert']; ?>');
	</script>
<?php $_SESSION['alert'] = null; endif; ?>
	<title>Add new domain</title>
	<style type="text/css">
		* {
			font-family: Helvetica;
		}
		button {
			cursor: pointer;
		}
		.cage {
			margin-top: 10px;
			border: 1px solid #000;
			width: 600px;
			height: 240px;
		}
	</style>
</head>
<body>
	<center>
		<div>
			<a href="?"><button>Back</button></a>
		</div>
		<div class="cage">
			<h2>Add new domain</h2>
			<form method="post" action="?action=1&amp;add_new_domain=1">
				<table>
					<tr><th>Domain</th><td>:</td><td><input type="text" name="domain" size="45" <?php print isset($_SESSION['domain']) ? "value=\"".htmlspecialchars($_SESSION['domain'])."\"" : ""; ?>></td></tr>
					<tr><th>Doc. Root</th><td>:</td><td><input type="text" name="document_root" value="<?php print htmlspecialchars(isset($_SESSION['document_root']) ? $_SESSION['document_root'] : $a['chroot']."/public"); ?>" 	size="45"></td></tr>
					<tr><th>Logs</th><td>:</td><td><input type="text" name="logs" value="<?php print htmlspecialchars(isset($_SESSION['logs']) ? $_SESSION['logs'] : $a['chroot']."/logs"); ?>" size="45"></td></tr>
					<tr><td colspan="3" align="center"><button type="submit" name="submit">Submit New Domain</button></td></tr>
				</table>
			</form>
		</div>
	</center>
</body>
</html>