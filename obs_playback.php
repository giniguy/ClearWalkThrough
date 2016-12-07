<?php
session_start();
 if (!isset($_SESSION['authenticated']) || !($_SESSION['authenticated'])) {
	 header("Location:index.php");
 }

require "dao.php";
$obsXID = $_GET['obsID'];
$dao = new dao;
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
	<div id="right"> <form method="post" action="dashboard.php">
			<button class="obs_cancel"><-- Back to Dashboard </button>
			</form>
		</div>
	<div id="selector" > 
	<?php 		// get details of observation
		$observations = $dao -> getObservation($obsXID);
			foreach ($observations as $observation) {
	?>
	<form method="post" id="obs_options" action="">
		<label class="selector">Teacher: </label>
				<?php 	// get teacher name from db
				$teachers = $dao -> getUserByID($observation["teacher"]); 
				foreach ($teachers as $teacher) {
					$firstname = $teacher["firstname"];
					$lastname = $teacher["lastname"];
				?>		
		<span> <?php echo "$firstname $lastname"; ?> </span>
			<?php	} // end foreach 	?>
		<label class="selector">Observer: </label>
				<?php 	// get observer name from db
				$observers = $dao -> getUserByID($observation["observer"]); 
				foreach ($observers as $observer) {
					$firstname = $observer["firstname"];
					$lastname = $observer["lastname"];
				?>		
		<span> <?php echo "$firstname $lastname"; ?> </span>
			<?php	} // end foreach 	?>
		<label class="selector">Date of Observation: </label>
		<span> <?php echo $observation["obsDate"]; ?> </span>
		<label class="selector">Class Period: </label>
		<span> <?php echo $observation["classPeriod"]; ?> </span>
		<label class="selector">Rating: </label>
			<?php $rating = $observation["rating"];   
					// translate from #.# to #_# for filename
				$stars = str_replace(".","_",$rating); ?>
		<img src="images/star<?php echo $stars;?>.png">
	<?php 			} // end foreach observations   ?>
	</form>
</div>

	<div id="dashboard">
		<div id="video_playback">
			<video width="450" controls>
			  <source src="videos/videofile.mp4" type="video/mp4">
				Your browser does not support the video tag.
			</video>
		</div> 
		<div id="comment_playback">
		<?php 
			$comments = $dao -> getObsComments($obsXID);
				foreach ($comments as $comment) {   ?>
		<table>
		<tr> 
			<td width="55px"><?php echo $comment["time"]; ?> </td>
			<td><?php echo $comment["comment"]; ?> </td>
		</tr>
			<?php	} // end foreach
			?>
		</div> <!-- comment_playback -->

	</div> <!-- dashboard -->

</div>  <!-- content -->

<div class="footer">
		<?php include "footer.php" 
		?>
</div>  <!-- footer -->
</div>  <!-- wrapper -->
</body>
</html>