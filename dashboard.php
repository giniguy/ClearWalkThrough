<?php
session_start();
 if (!isset($_SESSION['authenticated']) || !($_SESSION['authenticated'])) {
	 header("Location:index.php");
 }
?>

<html>
<head>
	<title>Dashboard</title>
	<link href="cwtstyle.css" type="text/css" rel="stylesheet" />
	<link href="favicon.ico" type="image/gif" rel="icon" />
	<link href="https://fonts.googleapis.com/css?family=Patua+One" rel="stylesheet">
	<script src="js/jquery.min.js"></script>
	<script> 
		$(document).ready(function(){
		  $("#dashbd-table").load("dashbd_table.php?role=Tchr");
		  $("#teacher").click(function(){
			$("#dashbd-table").load("dashbd_table.php?role=Tchr");
			$(".list").removeClass("active");
			$("#teacher").addClass("active");
		  });
		  $("#observer").click(function(){
			$("#dashbd-table").load("dashbd_table.php?role=Obsvr");
			$(".list").removeClass("active");
			$("#observer").addClass("active");
		  });
		});
	</script>

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
	<form action="obs_recorder.php">
		<button class="obs_button">NEW Observation</button>
	</form>
<div class="rounded_corners">
	<div class="listhead rounded_corners">
		My Observations
	</div> <!-- listhead -->
	<div id="teacher" class="list active">
		as Teacher
	</div> <!-- list -->
	<div id="observer" class="list"> 
		 as Observer 
	</div> <!-- list -->
</div>  <!-- rounded_corners -->
	
<!-- Other Observations menu selector not in use
<div class="rounded_corners">
	<div class="listhead rounded_corners">
		Other Observations
	</div> <!-- listhead -->
<!--	<a href=""> <div class="list">
		Shared with me 
	</div> </a> <!-- list -->
<!--	<a href=""><div class="list"> 
		 Recommended 
	</div> </a><!-- list -->
<!-- </div> <!-- rounded_corners -->

		</div> <!-- dashbd-menu -->
		<div id="dashbd-table">
			<?php // require_once "dashbd_table.php"; ?> 
		</div> <!-- dashbd-table -->
	</div> <!-- dashboard -->

</div>  <!-- content -->
	<div class="footer">
		<?php require_once "footer.php" ?>
	</div>  <!-- footer -->

</div>  <!-- wrapper -->
</body>
</html>