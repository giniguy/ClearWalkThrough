<?php 
session_start();
$_SESSION['presets']['email'] = $_GET['email'];
?>
<html>
<head>
	<title>Clear Walk Through</title>
	<link href="cwtstyle.css" type="text/css" rel="stylesheet" />
	<link href="favicon.ico" type="image/gif" rel="icon" />
</head>

<body>
<div class="wrapper">
<div class="header">
	<img src="images/CWT-banner.png" />	
</div> <!-- header -->

<div class="content">
	<div>
	<fieldset>
	  <form method="POST" action="handlers/pw_reset_handler.php">
		<p><span class="error">Forgot your password? </span><br> &nbsp; Type in a new password below. <br> 
		  &nbsp;  Passwords must be at least 8 characters.
		</p> <br>
		<label class="formheading" for="password"> New password: </label>
		<input id="password" name="password" type="password"> </input> 
			<span class="error">	
			<?php echo $_SESSION['errors']['passwordError']; 
			 // clear passwordError 
			$_SESSION['errors']['passwordError'] = ''; ?>
			</span><br>
		<label class="formheading" for="password2"> Confirm password: </label>
		<input id="password2" name="password2" type="password"> </input> 
			<br>
		<input type="submit" value="Submit">
	</form>
	</fieldset>
	</div> <!-- loginform -->
</div>  <!-- content -->

	<div class="footer">
		<?php require_once "footer.php" 
		?>
	</div>  <!-- footer -->
</div>  <!-- wrapper -->
</body>
</html>