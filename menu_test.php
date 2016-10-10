<html>
<head>
	<title>Clear Walk Through</title>
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
	require_once "nav.php";   // replace with banner on account pages 
?>
</div> <!-- header -->

<div class="content">

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
</div>  <!-- content -->

<div class="footer">
	<?php include "footer.php" 
	?>
</div>  <!-- footer -->
</div>  <!-- wrapper -->
</body>
</html>