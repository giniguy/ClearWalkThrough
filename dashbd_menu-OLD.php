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
	<div class="list">
		<ul>
		 <li> <a href="" class="active"> as Teacher </a> </li>
		 <li> <a href=""> as Observer </a> </li>
		</ul>
	</div> <!-- list -->
	</div>  <!-- rounded_corners -->
	
	<div class="rounded_corners">
	<div class="listhead rounded_corners">
		Other Observations
	</div> <!-- listhead -->
	<div class="list">
		<ul>
		 <li> <a href=""> Shared with me </a> </li>
		 <li> <a href=""> Recommended </a> </li>
		</ul>
	</div> <!-- list -->
	</div> <!-- rounded_corners -->
  </div> <!-- menu -->
</html>
<?php
?>