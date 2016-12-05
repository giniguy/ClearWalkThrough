<?php
session_start();
require "dao.php";

$dao = new dao;
$behaviorID = $_GET['behaviorID'];
?>
<html>
<div class="behavior2 comment_display">
	Rating
	<form id="obs_comments" method="post" action="handlers/comment_handler.php">
	<table>
		<?php // get comment details from db based on behavior
		$comments = $dao -> getComments($behaviorID);
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
			<td><label for="<?php echo $behaviorID; echo $value; ?>"><?php echo $name; ?></label></td>
		</tr>
	<?php	}  // end foreach $comments  
					// if recording in progress, display button to submit comment
			if ($_SESSION['recording']['activated']) { 	?>
				<tr> <td colspan="3" id="last_row"><button id="selectComment">Comment</button></td></tr>
			<?php }  // end if  ?>
	</table>
			<input type="hidden" name="commentID" value="<?php echo $ID; ?>"/>
	</form>

</div>
</html>