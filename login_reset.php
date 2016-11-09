<?php 
session_start();
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
	  <form method="POST" action="handlers/login_reset_handler.php">
		<p><span class="error">Trouble logging in? </span><br> &nbsp; Enter the email associated with your account below. <br> 
		  &nbsp;  An email will be sent to you with login information.
		</p> <br>
		<label class="formheading" for="email"> Email address: </label>
		<input id="email" name="email" value="<?php echo $_SESSION['presets']['email'] ?>" autofocus> </input> 
		<?php  // clear email preset
			$_SESSION['presets']['email'] = ''; ?>
			<span class="error">	
			<?php echo $_SESSION['messages']['emailNotFound']; 
			 // clear emailNotFound message
			$_SESSION['messages']['emailNotFound'] = ''; ?>
			<br>
		<input type="submit" value="Submit">
	</form>
	</fieldset>
	</div> <!-- loginform -->
	<div class="loginmessage">  </div>
	<div>

	<div>
	<fieldset>
		<label class="formheading"> Don't have an account? </label>
			<label class="columnright"> <a href="signup.php"> Click here to sign up </a>
			</label> <br>
		<label class="formheading"> </label>
			<label class="columnright"> <a href="index.php"> Back to Login </a>
			</label>
	</fieldset>
	</div> <!-- loginoption -->
</div>  <!-- content -->

	<div class="footer">
		<?php require_once "footer.php" 
		?>
	</div>  <!-- footer -->
</div>  <!-- wrapper -->
</body>
</html>