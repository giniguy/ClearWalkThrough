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
			$(".selectB").removeClass("active");
			$("#behavior_" + behaviorID).addClass("active");
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
						  <li><a href="#" onclick="loadComment('<?php echo $ID; ?>');"  id="behavior_<?php echo $ID; ?>" class="selectB"><?php echo $name; ?></a></li><br>
					<?php	}  // end foreach $behaviors  ?>

		</ul>
</div>
	<div id="comment_selector" class="behavior2 comment_display">
			<!--  load comment_selector.php here with loadDomain script -->		
	</div> <!-- comment_selector -->

</html>