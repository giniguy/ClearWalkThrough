<?php
require "dao.php";
$dao = new dao();
?>
<html>
<head>
<script>
$(document).ready(function() {
	$("#submit").click(function() {
		var teacher = $("#teacher").val();
		var date = $("#date").val();
		var period = $("#period").val();
	$("#returnmessage").empty(); // To empty previous error/success message.
	// Checking for blank fields.
if (teacher == 0 || date == '' || period == '') {
alert("Please select observation details");
} 
}
};
</script>
<head>


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
