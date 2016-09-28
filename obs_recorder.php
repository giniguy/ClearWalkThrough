
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
	<div> <form id="selector" action=""> 
		<select name="teachers">
			<option value="">Select Teacher</option>
			<option value="Teacher">Timothy Teacher</option>
			<option value="Instructor">Annie Instructor</option>
			<option value="Tutor">Tammy Tutor</option>
		</select>
		<label>Today's Date:
		</label>
		<input type="text" size="6" value="<?php echo date('m/d/y');?>"/>
		<label>Period:
		</label>
		<input type="text" name="period" size="1"/>
		<input type="submit" value="Begin Recording">
	</div>
	<div id="dashboard">
		<div id="video">
			Webcam: <br> <img src="images/video_recorder.png" />
		</div> <!-- video -->
		<div id="comments">
			Comments: <br>Comments will display here
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
