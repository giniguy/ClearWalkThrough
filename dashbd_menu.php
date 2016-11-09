<?php
?>
<html>
 <div id="menu">
	<form action="obs_recorder.php">
		<button class="obs_button">NEW Observation</button>
	</form>
	
	<div class="rounded_corners">
	<div class="listhead rounded_corners">
		My Observations
	</div> <!-- listhead -->

<!-- each of the links in the menu will display the dashboard 
		with observations populated from the database based on a query -->
	<a href=""> <div class="list active">
		as Teacher 
	</div> </a> <!-- list -->
	<a href=""><div class="list"> 
		 as Observer 
	</div> </a><!-- list -->
	
	</div>  <!-- rounded_corners -->
	
	<div class="rounded_corners">
	<div class="listhead rounded_corners">
		Other Observations
	</div> <!-- listhead -->
	<a href=""> <div class="list">
		Shared with me 
	</div> </a> <!-- list -->
	<a href=""><div class="list"> 
		 Recommended 
	</div> </a><!-- list -->
	
	</div> <!-- rounded_corners -->
  </div> <!-- menu -->

