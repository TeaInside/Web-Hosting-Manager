<!DOCTYPE html>
<html>
<head>
	<title>Welcome <?php print $a['username']; ?>!</title>
	<link rel="stylesheet" type="text/css" href="css/home_user.css">
</head>
<body>
<center>
	<div class="navbar">
		<a href="logout.php?ref=home_panel&amp;w=<?php print rstr(32); ?>"><button class="btn">Logout</button></a>
	</div>
	<script type="text/javascript">
		function showMenus(link, title, ico)
		{
			document.write(
				'<a href="'+link+'" target="_blank">' +
					'<div class="blk">' +
						'<h2>'+title+'</h2>' +
						'<img class="mimage" src="'+ico+'">' +
					'</div>' +
				'</a>\n'
			);
		}
		var menus = {
			"File Manager": [
				"panel/elfinder.php?user=<?php print $a['username']; ?>",
				"img/ico/file_manager.ico"
			],
			"Adminer": [
				"panel/adminer.php",
				"img/ico/adminer.png"
			],
			"Domain Management": [
				"panel/domain_management.php",
				"img/ico/domain.png"
			]
		}, x;
		for (x in menus) {
			showMenus(menus[x][0], x, menus[x][1]);
		}
	</script>
</center>
</body>
</html>