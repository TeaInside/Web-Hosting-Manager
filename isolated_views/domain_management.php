<?php
if (isset($_GET['delete'])) {
	if (isset($_POST['submit'])) {
		$map = json_decode(file_get_contents(sites_available."/map"));
		$map = is_array($map) ? $map : [];
		unset($map[array_search($_GET['delete'], $map)], $a['domains'][$_GET['delete']]);
		file_put_contents(sites_available."/map", json_encode($map, 128));
		$cmd = [
			"sudo rm -rf ".sites_available."/".$a['username']."_".$_GET['delete'].".conf",
			"sudo rm -rf /etc/apache2/sites-enabled/".$a['username']."_".$_GET['delete'].".conf"
		];
		if ($_POST['mode'] == 2) {
			$cmd[] = ["sudo rm -rf ".$a['domains'][$_GET['delete']]]['document_root'];
		}
		foreach ($cmd as $val) {
			shell_exec($val);
		}
		$_SESSION['delete'] = $_GET['delete'];
		redirect("?");
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Delete <?php print $_GET['delete']; ?></title>
</head>
<body>
<center>
	<div style="border:2px solid #000;width:700px;height:170px;">
		<form method="post" action="?action=1&amp;delete=<?php print urlencode($_GET['delete']); ?>">
			<h2>Delete domain <?php print $_GET['delete']; ?></h2>
			<table>
				<tr>
					<td><input type="radio" name="mode" value="1" checked></td> 
					<td>Keep files</td>
				</tr>
				<tr>
					<td><input type="radio" name="mode" value="2"></td> 
					<td>Delete all files in <?php print $a['domains'][$_GET['delete']]['document_root']; ?></td>
				</tr>
				<tr></tr>
				<tr><td colspan="2" align="center"><button style="cursor:pointer;" type="submit" name="submit">Delete domain</button></td></tr>
			</table>
		</form>
	</div>
</center>
</body>
</html>
<?php
die;
}
?>
<!DOCTYPE html>
<html>
<head>
	<?php if (isset($_SESSION['delete'])): ?>
		<script type="text/javascript">
			alert('<?php print $_SESSION['delete'] ?> has been deleted!');
		</script>
	<?php 

	$_SESSION['delete'] = null;

	endif; ?>
	<title>Domain Management</title>
	<link rel="stylesheet" type="text/css" href="../css/domain_management.css">
</head>
<body>
<center>
	<div style="margin-bottom: 10px;">
		<a href="../home.php?ref=elfinder&amp;w=<?php print urlencode(rstr(64)); ?>"><button>Back to home</button></a>
		<a href="../logout.php?ref=elfinder&amp;w=<?php print urlencode(rstr(64)); ?>"><button>Logout</button></a>
	</div>
	<div class="main-cage">
		<div>
			<button>Add New Domain</button>
		</div>
		<?php foreach ($a['domains'] as $key => $val): ?>
			<div class="sub-cage">
				<table>
					<tr><th align="left">Domain</th><td>:</td><td><?php print htmlspecialchars($key); ?></td></tr>
					<tr><th align="left">Doc. Root</th><td>:</td><td><?php print htmlspecialchars($val['document_root']); ?></td></tr>
					<tr><th align="left">Logs</th><td>:</td><td><?php print htmlspecialchars($val['logs']); ?></td></tr>
					<tr></tr>
					<tr></tr>
				</table>
				<a href="?manage=<?php print urlencode($key); ?>"><button>Setting</button></a>
				<a href="?delete=<?php print urlencode($key); ?>"><button>Delete</button></a>
				<a href="?reload=<?php print urlencode($key); ?>"><button>Reload</button></a>
			</div>
		<?php endforeach; ?>
	</div>
</center>
</body>
</html>