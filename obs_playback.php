<?php
session_start();
?>

<html>
<head>
	<title>Observation Playback</title>
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
	<div id="right"> <a href="dashboard.php"> <-- Back to Dashboard </a>
		</div>
	<div id="dashboard">
		<div id="video">
			<iframe width="560" height="315" src="https://www.youtube.com/embed/K7Hn1rPQouU" frameborder="0" allowfullscreen></iframe>
		</div> <!-- video -->
		<div id="comments">
			Comments will display here
		</div> <!-- comments -->

	</div> <!-- dashboard -->

</div>  <!-- content -->

<div class="footer">
		<?php include "footer.php" 
		?>
</div>  <!-- footer -->
</div>  <!-- wrapper -->
</body>
</html>