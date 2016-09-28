<html>
<head>
	<title>Dashboard</title>
	<link href="cwtstyle.css" type="text/css" rel="stylesheet" />
	<link href="favicon.ico" type="image/gif" rel="icon" />
</head>

<body>
<div class="wrapper">
<div class="header">
<?php
	require_once "nav.php";
?>
</div> <!-- header -->

<div class="content">
	<div id="dashboard">
		<div id="dashbd-menu">
			<?php
				require_once "dashbd_menu.php";
			?>
		</div> <!-- dashbd-menu -->
		<div id="dashbd-table">
			<?php
				require_once "dashbd_table.php";
			?>
		</div> <!-- dashbd-table -->

	</div> <!-- dashboard -->

</div>  <!-- content -->

<div class="footer">
		<?php include "footer.php" 
		?>
</div>  <!-- footer -->
</div>  <!-- wrapper -->
</body>
</html>