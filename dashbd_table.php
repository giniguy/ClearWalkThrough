<?php
require "dao.php";
?>
<html>
	<div class="table_corners">
	<table>
		<th class="rounded_corners" colspan="6">Observations List</th>
	</table>
	<table>
		<tr> 
<!-- 			<th> Teacher
			</th> -->
			<th> Observer
			</th>
			<th> Date
			</th>
			<th> Per
			</th>
			<th> Rating
			</th>
			<th> Length
			</th>
			<th> View
			</th>
		</tr>
<?php 
// get data from db
$userID = $_SESSION['user']['userID'];
$dao = new dao();
$rows = $dao -> getTchrObservation($userID);
	foreach ($rows as $row) {
?>
		<tr>  
<!-- 			<td> <?php echo $row["firstname"];?> <?php echo $row["lastname"];?>
			</td> -->
			<td> <?php echo $row["firstname"];?> <?php echo $row["lastname"];?>
			</td>
			<td> <?php echo $row["obsDate"]; ?>
			</td>
			<td> <?php echo $row["classPeriod"]; ?>
			</td>
			<td> <?php $rating = $row["rating"]; 
				$stars = str_replace(".","_",$rating); ?>
				<img src="images/star<?php echo $stars;?>.png"> 
			</td>
			<td> <?php echo $row["obsLength"]; ?>
			</td>
			<td> <a href="obs_playback.php?<?php echo $row["obsID"]; ?>"><img src="images/play.png"></a>
			</td>
		</tr>
	<?php  }  // end foreach  
	?>
	</table> 
	</div> <!-- rounded_corners -->
  </div> <!-- table_corners -->
