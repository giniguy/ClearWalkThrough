<?php 
session_start();
 if (!isset($_SESSION['authenticated']) || !($_SESSION['authenticated'])) {
	 header("Location:index.php");
 }

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
  
function loadBehavior(domainID) {
		$("#behavior_selector").load("behavior_selector.php?domainID=" + domainID);
			$(".selectD").removeClass("active");
			$("#domain_" + domainID).addClass("active");
};

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
	
	<div id="selector" > 
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
			<option value="<?php echo $ID; ?>"><?php echo $firstname; echo" "; echo $lastname;?></option>
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
// var_dump($_SESSION['recording']);
?>
	<div id="right"> <button class="obs_disable"><-- Back to Dashboard </button>
	</div>

	<div id="selector" > 
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
		  <li><a href="#" onclick="loadBehavior('<?php echo $ID; ?>');" id="domain_<?php echo $ID; ?>" class="selectD"><?php echo $name; ?></a></li>
		  <?php	}  // end foreach  ?>
		</ul>

		<div id="behavior_selector" class="domain2 comment_display">
			<!--  load behavior_selector.php here with loadDomain script -->
		</div>
		</div> <!-- domain_selector div -->
		<div id="free_comment">
		<form method="post" action="handlers/comment_handler.php"> 
		<input type="text" name="comment_text" placeholder="Type additional comments here" />
		<input type="hidden" name="comment_value" value="0-0"/>
<?php					// if recording in progress, display button to submit comment
			if ($_SESSION['recording']['activated']) { 	?>
				<button id="freeComment">Comment</button>
			<?php }  // end if  ?>
		</form>
		</div> <!-- free_comment -->

	</div> <!-- dashboard -->

</div> <!-- content -->	

<div class="footer">
		<?php include "footer.php" 
		?>
</div>  <!-- footer -->
</div>  <!-- wrapper -->
</body>
</html>
