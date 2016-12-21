<?php
session_start();
 if (!isset($_SESSION['authenticated']) || !($_SESSION['authenticated'])) {
	 header("Location:index.php");
 }

require "dao.php";

$dao = new dao;
$behaviorID = $_GET['behaviorID'];
?>
<html>
<head>
	<script>
	$(document).ready(function() {
		$("#selectComment").click(function() {
			var comment2post = $("#comment_value").val();
			$.post("handlers/comment_handler.php", comment_value:comment2post), 
				function(response,status){
					alert("*----Received Data----*\n\nResponse : " + response+"\n\nStatus : " + status);
			}
		}
	);	
	});
	</script>
</head>
<div class="behavior2 comment_display">
	Rating
	<form id="obs_comments" method="post" action="handlers/comment_handler">
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

</div>
</html>