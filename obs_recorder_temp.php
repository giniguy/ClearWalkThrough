<?php 
session_start();
require "dao.php";
$dao = new dao;
?>
<html>
<head>
	<title>Observation Recorder</title>
	<link href="cwtstyle.css" type="text/css" rel="stylesheet" />
	<link href="favicon.ico" type="image/gif" rel="icon" />
</head>

<body>
<script>
function openDomain(domainName) {
    var i;
    var x = document.getElementsByClassName("domain");
    for (i = 0; i < x.length; i++) {
       x[i].style.display = "none";
    }
    document.getElementById(domainName).style.display = "block";
}

function openBehavior(behaviorName) {
    var j;
    var x = document.getElementsByClassName("behavior");
    for (j = 0; j < x.length; j++) {
       x[j].style.display = "none";
    }
    document.getElementById(behaviorName).style.display = "block";
}
</script>
<div class="wrapper">
<div class="header">
<?php
	require_once "nav.php";
?>
</div> <!-- header -->

<div class="content">
	<div id="right"> <a href="dashboard.php"> <-- Back to Dashboard </a>
		</div>
	<div id="selector" > <form method="post" action=""> 
		<select name="teachers">   
		<option value="0">Select . . .</option>
			<?php 	// get teachers from db to populate selector
				$teachers = $dao -> getTeachers();
				foreach ($teachers as $teacher) {
					$ID = $teacher["userID"];
					$firstname = $teacher["firstname"];
					$lastname = $teacher["lastname"];
			?>
		<option value="<?php echo $ID; ?>"><?php echo $firstname; echo" "; echo $lastname;?></option>
			<?php	} // end foreach 	?>
		</select>
		<label>Date of Observation:
		</label>
		<input type="text" size="6" value="<?php echo date('m/d/y');?>"/>
		<label>Class Period:
		</label>
		<input type="text" name="period" size="1"/>
		<input type="submit" value="Begin Recording">
	</div>
	<div id="dashboard">
		<div id="video">
			Webcam: <br> <img src="images/video_recorder.png" />
		</div> <!-- video -->
		<div id="comments">
			Comments: <br> 			
			Selected comments display here <br>
		</div> <!-- comments -->	
		
	<div id="domain_selector">
	Domains of Observation
		<ul class="tabmenu">
			<?php 	// get domains from db
				$domains = $dao -> getDomains();
				$domain_array = [];
				foreach ($domains as $domain) {
					$ID = $domain["domainID"];
					$name = $domain["domain"];
				$domain_array[] = $ID; 
			?>
		  <li><a href="#" onclick="openDomain('<?php echo $ID; ?>');"><?php echo $name; ?></a></li>
			<?php	}  // end foreach  ?>
		</ul>
		<?php 
			// iterate over domain_array and prepare domain divs for display
		foreach ($domain_array as $domain_div) {
			?>
			<div id="<?php echo $domain_div; ?>" class="domain comment_display">
			Observed Student Behaviors
				<ul class="tabmenu">
					<?php // get behaviors from db based on domain
						$behaviors = $dao -> getBehaviors($domain_div);
						$behavior_array = [];
						foreach ($behaviors as $behavior) {
							$ID = $behavior["behaviorID"];
							$name = $behavior["behavior"];
						$behavior_array[] = $ID;
					?>
						  <li><a href="#" onclick="openBehavior('<?php echo $ID; ?>');"><?php echo $name; ?></a></li>
					<?php	}  // end foreach $behaviors  ?>
				</ul>
		</div> <!-- domain_div -->
				
		<?php 	}  // end foreach $domain_array		?> 


	</div> <!-- domain_selector -->	

	</div> <!-- dashboard -->

</div>  <!-- content -->

<div class="footer">
		<?php include "footer.php" 
		?>
</div>  <!-- footer -->
</div>  <!-- wrapper -->
</body>
</html>
