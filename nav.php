<html>
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
		<a href="logout.php"> Log out </a>
	</div>
	
	<div id="navline">
		<hr>
	</div>
  </div> <!-- nav -->
</html>
<?php
?>