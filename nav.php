<html>
<head>
<link href="https://fonts.googleapis.com/css?family=Patua+One" rel="stylesheet">

</head>
<div id="navlogo">
	<img src="images/CWT-logo-small.png" />
</div>
 <div id="nav">
	<div id="navleft"> 
		<?php echo $_SESSION['user']['firstname']; echo " ";
		echo $_SESSION['user']['lastname'];
	?>
	</div>
	<div id="navcenter">
		
	</div>
	<div id="navright">
 <form method="post" action="logout.php">
			<button class="obs_cancel">Log out</button>
			</form>	</div>
	
	<div id="navline">
		<hr>
	</div>
  </div> <!-- nav -->
</html>
<?php
?>