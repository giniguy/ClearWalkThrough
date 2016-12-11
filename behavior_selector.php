<?php
session_start();
 if (!isset($_SESSION['authenticated']) || !($_SESSION['authenticated'])) {
	 header("Location:index.php");
 }

require "dao.php";

$dao = new dao;
$domainID = $_GET['domainID'];

?>
<html>
<head>
	<script>
function loadComment(behaviorID) {
		$("#comment_selector").load("comment_selector.php?behaviorID=" + behaviorID);
			$(".list").removeClass("active");
			$("#2").addClass("active");
};
	</script>

</head>
<div class="domain2 comment_display">
	Observed Student Behaviors
		<ul class="tabmenu">
					<?php // get behaviors from db based on domain
						$behaviors = $dao -> getBehaviors($domainID);
						foreach ($behaviors as $behavior) {
							$ID = $behavior["behaviorID"];
							$name = $behavior["behavior"];
					?>
						  <li id="<?php echo $ID; ?>" class="active"><a href="#" onclick="loadComment('<?php echo $ID; ?>');" ><?php echo $name; ?></a></li>
					<?php	}  // end foreach $behaviors  ?>

		</ul>
</div>
	<div id="comment_selector" class="behavior2 comment_display">
			<!--  load comment_selector.php here with loadDomain script -->		
	</div> <!-- comment_selector -->

</html>