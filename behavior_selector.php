<?php
session_start();
require "dao.php";

$dao = new dao;
$behaviorID = $_GET['behaviorID'];
echo $domainID;
?>
<html>
<head>
	<script>
function loadComment(behaviorID) {
		$("#comment_selector").load("comment_selector.php?behaviorID=behaviorID");
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
						  <li><a href="#" onclick="loadComment('<?php echo $ID; ?>');"><?php echo $name; ?></a></li>
					<?php	}  // end foreach $behaviors  ?>

		</ul>
</div>
	<div id="comment_selector" class="domain2 comment_display">
			<!--  load comment_selector.php here with loadDomain script -->		
	</div> <!-- comment_selector -->

</html>