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
	<script src="js/jquery.min.js"></script>
	<script src="js/validate/dist/jquery.validate.js"></script>
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

$(document).ready(function(){
    $("#selectComment").click(function(){
        $("#comments").append("<li>Appended item</li>");
    });
});

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
	
<div id="selector"> 
	<form method="post" id="obs_options" action="handlers/begin_recording_handler.php"> 
		<label class="selector">Teacher: </label>
		<select name="teacher">   
			<option value=''>Select . . .</option>
			<?php 	// get teachers from db to populate selector
				$teachers = $dao -> getTeachers($_SESSION['user']['userID']);  // pass logged in user to function so it will be omitted from list
				foreach ($teachers as $teacher) {
					$ID = $teacher["userID"];
					$firstname = $teacher["firstname"];
					$lastname = $teacher["lastname"];
			?>
			<option value="<?php echo $ID; ?>"><?php echo "$firstname $lastname";?></option>
			<?php	} // end foreach 	?>
		</select>
		<label class="selector">Date of Observation: </label>
<!--date selector			<input type="date" size="6" name="date" id="date"/> -->
			<input type="text" size="8" name="date" value="<?php echo date("m/d/Y"); ?>" readonly/>
		<label class="selector">Class Period: </label>
		<select name="period">   
			<option value="">Select . . .</option>
			<option value="0">0</option>
			<option value="1">1</option>
			<option value="2">2</option>
			<option value="3">3</option>
			<option value="4">4</option>
			<option value="5">5</option>
			<option value="6">6</option>
			<option value="7">7</option>
		</select>

		<button id="submit" class="obs_start">Begin Recording</button>	
	</form>
<script>	
$("#obs_options").validate({
		rules: {
			teacher: {required: true },
			date: {
				required: true,
				date: true,
				},
			period: {required: true }
		},
		messages: {
			teacher: {required: "Select a teacher" },
			date: {required: "Enter today's date" },
			period: {required: "Select the class period" }
		}
});
</script>
</div> 
<?php } else {  // recording in progress, display details  
 var_dump($_SESSION['recording']);
?>
	<div id="right"> <button class="obs_disable"><-- Back to Dashboard </button>
	</div>

<div id="selector"> 
	<form method="post" action="handlers/stop_recording_handler.php"> 
		<label class="selector">Teacher: </label>
		<input type="text" name="teacher" value="<?php echo $_SESSION['recording']['teacherName']; ?>" readonly/>
		<label class="selector">Date of Observation: </label>
		<input type="text" size="6" name="date" value="<?php echo $_SESSION['recording']['obsDate']; ?>" readonly/>
		<label class="selector">Class Period: </label>
		<input type="text" name="period" size="1" value="<?php echo $_SESSION['recording']['classPeriod']; ?>" readonly/>
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
			Comments: <br> <br>			
			00:00 start recording
			
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
					<form id="obs_comments" method="post" action="handlers/comment_handler.php">
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
									$submit = "$ID-$value";
							?>
							<tr>
								<td><input type="radio" name="comment_value" id="<?php echo $behaviorID; echo $value; ?>" value="<?php echo $submit; ?>"/></td>
								<td><label for="<?php echo $behaviorID; echo $value; ?>"><?php echo $rating; ?></label></td>
								<td><label for="<?php echo $behaviorID; echo $value; ?>"><?php echo $name; ?></label></td>
							</tr>
							<?php	}  // end foreach $comments  
							// if recording in progress, display button to submit comment
						if ($_SESSION['recording']['activated']) { 	?>
							<tr> <td colspan="3" id="last_row"><button id="selectComment">Comment</button></td></tr>
						<?php }  // end if  ?>
						</table>
						</form>
<script>	
$("#obs_comments").validate({
		rules: {
			comment_value: {
				required: true,
				}
		},
		messages: {
			comment_value: {required: "Select a rating" }
		}	
});
</script>

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
