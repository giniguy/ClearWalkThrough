<?php
session_start();
require "dao.php";
$userID = $_SESSION['user']['userID'];
$role = $_GET['role']; 
	
?>
<html>
	<div class="table_corners">
	<table>
		<th class="rounded_corners" colspan="6">Observations List</th>
	</table>
	<table>
	<tr> 
 			<th> Teacher </th> 
			<th> Observer </th>
			<th> Date </th>
			<th> Per </th>
			<th> Rating </th>
			<th> Length </th>
			<th> View </th>
		</tr>
<?php
// get data from db
$dao = new dao();
if ($role=='Tchr') {
	$rows = $dao -> getTchrObservation($userID);
		foreach ($rows as $row) {
?>
		<tr>  
			<td> <?php echo $_SESSION['user']['firstname'];?> <?php echo $_SESSION['user']['lastname'];?>
			</td> 
 			<td> <?php echo $row["firstname"];?> <?php echo $row["lastname"];?>
			</td>
			<td> <?php echo $row["obsDate"]; ?>
			</td>
			<td> <?php echo $row["classPeriod"]; ?>
			</td>
			<td> <?php $rating = $row["rating"];   
					// translate from #.# to #_# for filename
				$stars = str_replace(".","_",$rating); ?>
				<img src="images/star<?php echo $stars;?>.png"> 
			</td>
			<td> <?php echo $row["obsLength"]; ?>
			</td>
			<td> <a href="obs_playback.php?obsID=<?php echo $row["xternalID"]; ?>"><img src="images/play.png"></a>
			</td>
		</tr>
	<?php  }  // end foreach  

 } // end if teacher
 
if ($role=='Obsvr') {
	$rows = $dao -> getObsvrObservation($userID);
		foreach ($rows as $row) {
?>
		<tr>  
			<td> <?php echo $row["firstname"];?> <?php echo $row["lastname"];?>
			</td> 
 			<td> <?php echo $_SESSION['user']['firstname'];?> <?php echo $_SESSION['user']['lastname'];?>
			</td>
			<td> <?php echo $row["obsDate"]; ?>
			</td>
			<td> <?php echo $row["classPeriod"]; ?>
			</td>
			<td> <?php $rating = $row["rating"];   
					// translate from #.# to #_# for filename
				$stars = str_replace(".","_",$rating); ?>
				<img src="images/star<?php echo $stars;?>.png"> 
			</td>
			<td> <?php echo $row["obsLength"]; ?>
			</td>
			<td> <a href="obs_playback.php?obsID=<?php echo $row["xternalID"]; ?>"><img src="images/play.png"></a>
			</td>
		</tr>
	<?php  }  // end foreach  
 } // end if observer
	?>
	</table> 
	</div> <!-- rounded_corners -->
  </div> <!-- table_corners -->
