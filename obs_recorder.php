<?php 
session_start();
?>
<html>
<head>
	<title>Observation Playback</title>
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
		<select name="teachers">   <!-- user datalist? -->
			<option value="">Select Teacher</option>
			<option value="Teacher">Timothy Teacher</option>
			<option value="Instructor">Annie Instructor</option>
			<option value="Tutor">Tammy Tutor</option>
		</select>
		<label>Today's Date:
		</label>
		<input type="text" size="6" value="<?php echo date('m/d/y');?>"/>
		<label>Period:
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
		  <li><a href="#" onclick="openDomain('culture');">Culture of Learning</a></li>
		  <li><a href="#" onclick="openDomain('content')"> Essential Content</a></li>
		  <li><a href="#" onclick="openDomain('academic')">Academic Ownership</a></li>
		  <li><a href="#" onclick="openDomain('demonstration')">Demonstration of Learning</a></li>
		</ul>

		<div id="culture" class="domain comment_display">
		Observed Student Behaviors
			<?php
				include "cultureoflearning.php";
			?>
		</div> <!-- domain -->
		
		<div id="content" class="domain comment_display">
		Observed Student Behaviors
			<?php
				include "essentialcontent.php";
			?>
		</div> <!-- domain -->
		
		<div id="academic" class="domain">
		Observed Student Behaviors
			<?php
				include "academicownership.php";
			?>
		</div> <!-- domain -->
		<div id="demonstration" class="domain">
		Observed Student Behaviors
			<?php
				include "demonstrationoflearning.php";
			?>
		</div> <!-- domain -->	
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
