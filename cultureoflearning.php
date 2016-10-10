<?php
?>
<html>
<script>
function openBehavior(behaviorName) {
    var i;
    var x = document.getElementsByClassName("behavior");
    for (i = 0; i < x.length; i++) {
       x[i].style.display = "none";
    }
    document.getElementById(behaviorName).style.display = "block";
}
</script>

	<ul class="tabmenu">
	  <li><a href="#" onclick="openBehavior('behavior1');">Students Complete Instructional Tasks</a></li>
	  <li><a href="#" onclick="openBehavior('behavior2');">Students Volunteer Responses</a></li>
	  <li><a href="#" onclick="openBehavior('behavior3');">Students Ask Appropriate Questions</a></li>
	  <li><a href="#" onclick="openBehavior('behavior4');">Students Follow Behavioral Expectations and/or Directions</a></li>
	  <li><a href="#" onclick="openBehavior('behavior5');">Students Execute Transitions, Routines, and Procedures</a></li>
	  <li><a href="#" onclick="openBehavior('behavior6');">Students Working/On Task</a></li>
	</ul>
	
	<div id="behavior1" class="behavior comment_display">
		Are all students engaged in the work of the lesson from start to finish?
			<?php
				include "cultureoflearning_behavior1.php";
			?>
	</div> <!-- domain -->
