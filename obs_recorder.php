<?php 
session_start();
 if (!isset($_SESSION['recording'])) {
	$_SESSION['recording'] = array('activated' => false,
							'obsID' => "",
							'teacherID' => "",
							'teacherName' => "",
							'obsDate' => "",
							'classPeriod' => 0,
							'startTime' => "",
							'stopTime' => "",						
							'elapsedTime' => "",
							'commentCount' => 0,
							'commentTotal' => 0,
							'rating' => 0,
							'videofile' => ""
							);
 } 

require "dao.php";
$dao = new dao;
	
?>
<html>
<head>
	<title>Observation Recorder</title>
	<link href="cwtstyle.css" type="text/css" rel="stylesheet" />
	<link href="favicon.ico" type="image/gif" rel="icon" />
</head>

<body>
<script>
  
function openDomain(domainName) {
    var i;
    var x = document.getElementsByClassName("domain");
    for (i = 0; i < x.length; i++) {
       x[i].style.display = "none";
    }
		var j;
		var y = document.getElementsByClassName("behavior");
		for (j = 0; j < y.length; j++) {
		   y[j].style.display = "none";
		}
    document.getElementById(domainName).style.display = "block";
}

function openBehavior(behaviorName) {
    var j;
    var y = document.getElementsByClassName("behavior");
    for (j = 0; j < y.length; j++) {
       y[j].style.display = "none";
    }
    document.getElementById(behaviorName).style.display = "block";
}

</script>
<div class="wrapper">
<div class="header">
<?php
	require_once "nav.php";
?>
</div> <!-- header -->

<div class="content">
<?php if (!$_SESSION['recording']['activated']) {  // display form to begin recording ?>
	<div id="right"> <form method="post" action="dashboard.php">
			<button class="obs_cancel"><-- Back to Dashboard </button>
			</form>
	</div>
	
	<div id="selector" > 
	<form method="post" action="handlers/begin_recording_handler.php"> 
		<label class="selector">Teacher: </label>
		<select name="teacher">   
		<option value="0">Select . . .</option>
			<?php 	// get teachers from db to populate selector
				$teachers = $dao -> getTeachers($_SESSION['user']['userID']);  // pass logged in user to function so it will be omitted from list
				foreach ($teachers as $teacher) {
					$ID = $teacher["userID"];
					$firstname = $teacher["firstname"];
					$lastname = $teacher["lastname"];
			?>
		<option value="<?php echo $ID; ?>"><?php echo $firstname; echo" "; echo $lastname;?></option>
			<?php	} // end foreach 	?>
		</select>
		<label class="selector">Date of Observation: </label>
		<input type="date" size="6" name="date"/>
		<label class="selector">Class Period: </label>
		<input type="text" name="period" size="1"/>
		<button id="submit" class="obs_start">Begin Recording</button>	
	</form>
	</div> 
<?php } else {  // recording in progress, display details  
// var_dump($_SESSION['recording']);
?>
	<div id="right"> <button class="obs_disable"><-- Back to Dashboard </button>
	</div>

	<div id="selector" > 
	<form method="post" action="handlers/stop_recording_handler.php"> 
		<label class="selector">Teacher: </label>
		<input type="text" name="teacher" value="<?php echo $_SESSION['recording']['teacherName']; ?>"/>
		<label class="selector">Date of Observation: </label>
		<input type="text" size="6" name="date" value="<?php echo $_SESSION['recording']['obsDate']; ?>"/>
		<label class="selector">Class Period: </label>
		<input type="text" name="period" size="1" value="<?php echo $_SESSION['recording']['classPeriod']; ?>"/>
		<button class="obs_stop">Stop Recording</button>	
	</form>
</div>
<?php } // end else
?>

	<div id="dashboard">
		<div id="video">
			Webcam: <br> <img src="images/video_recorder.png" />
		</div> <!-- video -->
		<div id="comments">
			Comments: <br> 			
			Selected comments display here <br>
		</div> <!-- comments -->	
		
	<div id="domain_selector">
	Domains of Observation
		<ul class="tabmenu">
			<?php 	// get domains from db
				$domains = $dao -> getDomains();
				$domain_array = [];
				foreach ($domains as $domain) {
					$ID = $domain["domainID"];
					$name = $domain["domain"];
				$domain_array[] = $ID; 
			?>
		  <li><a href="#" onclick="openDomain('domain_<?php echo $ID; ?>');"><?php echo $name; ?></a></li>
			<?php	}  // end foreach  ?>
		</ul>
		<?php 
			// iterate over domain_array and prepare domain divs for display
		foreach ($domain_array as $domain_div) {
			?>
			<div id="domain_<?php echo $domain_div; ?>" class="domain comment_display">
			Observed Student Behaviors
				<ul class="tabmenu">
					<?php // get behaviors from db based on domain
						$behaviors = $dao -> getBehaviors($domain_div);
						$behavior_array = [];
						foreach ($behaviors as $behavior) {
							$ID = $behavior["behaviorID"];
							$name = $behavior["behavior"];
						$behavior_array[] = $ID;
					?>
						  <li><a href="#" onclick="openBehavior('behavior_<?php echo $ID; ?>');"><?php echo $name; ?></a></li>
					<?php	}  // end foreach $behaviors  ?>
				</ul>

				<?php 
					//iterate over behavior_array and prepare behavior divs for display
				foreach ($behavior_array as $behavior_div) {
					?>
					<div id="behavior_<?php echo $behavior_div; ?>" class="behavior comment_display">
					Rating
					<form method="post" action="handlers/comment_handler.php">
						<table>
							<?php // get comment details from db based on behavior
								$comments = $dao -> getComments($behavior_div);
								foreach ($comments as $comment) {
									$ID = $comment["commentID"];
									$name = $comment["comment"];
									$rating = $comment["rating"];
									$value = $comment["value"];
									$keyword = $comment["keywords"];
									$behaviorID = $comment["behaviorID"];
							?>
							<tr>
								<td><input type="radio" name="comment_value" id="<?php echo $behaviorID; echo $value; ?>" value="<?php echo $value; ?>"/></td>
								<td><label for="<?php echo $behaviorID; echo $value; ?>"><?php echo $rating; ?></label></td>
								<td><label for="<?php echo $behaviorID; echo $value; ?>"><?php echo $keyword; ?></label></td>
							</tr>
							<tr>
								<td></td>
								<td colspan="2"><label for="<?php echo $behaviorID; echo $value; ?>"><?php echo $name; ?></label></td>
							</tr>
							<?php	}  // end foreach $comments  ?>
							<tr> <td colspan="3"><button>Comment</button></td></tr>
						</table>
							<input type="hidden" name="commentID" value="<?php echo $ID; ?>"/>
						</form>
					</div> <!-- behavior div -->
				<?php  }  // end foreach $behavior_array   ?>

			</div> <!-- domain_div -->
		<?php 	}  // end foreach $domain_array		?> 

	</div> <!-- domain_selector -->	

	</div> <!-- dashboard -->

</div>  <!-- content -->

<div class="footer">
		<?php include "footer.php" 
		?>
</div>  <!-- footer -->
</div>  <!-- wrapper -->
</body>
</html>
