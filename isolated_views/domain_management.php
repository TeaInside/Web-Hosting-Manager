<!DOCTYPE html>
<html>
<head>
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
		<!-- <div>
			<button>Add New Domain</button>
		</div> -->
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
				<!-- <a href="?delete=<?php print urlencode($key); ?>"><button>Delete</button></a> -->
				<a href="?reload=<?php print urlencode($key); ?>"><button>Reload</button></a>
			</div>
		<?php endforeach; ?>
	</div>
</center>
</body>
</html>