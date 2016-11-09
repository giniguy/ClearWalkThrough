<?php
session_start();
?>
<html>
<head>
	<title>Account Sign Up</title>
	<link href="cwtstyle.css" type="text/css" rel="stylesheet" />
	<link href="favicon.ico" type="image/gif" rel="icon" />
</head>

<body>
<div class="wrapper">
<div class="header">
	<img src="images/CWT-banner.png" />	
</div> <!-- header -->

<div class="content">
<a href="logout.php" >LOGOUT</a>
	<div>
	<fieldset>
	Enter information for your account below. </br>All fields are required.</br></br>
	 <form method="POST" action="handlers/signup_handler.php">
	 	<label class="formheading" for="role"> Account Type: </label>
			<select name="role">
				<option value = 1 selected>Teacher</option>
				<option value = 2>Observer</option>
			</select>
		<br>
		<label class="formheading" for="firstname"> First Name: </label>
		<input id="firstname" name="firstname" value="<?php echo $_SESSION['presets']['firstname'] ?>" autofocus> </input>
		<span class="error">	<?php IF (isset($_SESSION['errors']['firstnameError'])) {
				echo $_SESSION['errors']['firstnameError'];
				} ?>
		</span><br>
		
		<label class="formheading" for="lastname"> Last Name: </label>
		<input id="lastname" name="lastname" value="<?php echo $_SESSION['presets']['lastname'] ?>"> </input>
		<span class="error">	<?php IF (isset($_SESSION['errors']['lastnameError'])) {
				echo $_SESSION['errors']['lastnameError'];
				} ?>
		</span><br>

		<label class="formheading" for="email"> Email Address: </label>
		<input id="email" name="email" value="<?php echo $_SESSION['presets']['email'] ?>"> </input> 
				<span class="error">	<?php IF (isset($_SESSION['errors']['emailError'])) {
				echo $_SESSION['errors']['emailError'];
				} ?>
		</span><br>

		<label class="formheading" for="email2"> Verify Email Address: </label>
		<input id="email2" name="email2" value="<?php echo $_SESSION['presets']['email2'] ?>"> </input> 
		<span class="error">	<?php IF (isset($_SESSION['errors']['email2Error'])) {
				echo $_SESSION['errors']['email2Error'];
				} ?>
		</span><br>

		<label class="formheading" for="username"> User Name: </label>
		<input id="username" name="username" value="<?php echo $_SESSION['presets']['username'] ?>"> </input>
		<span class="error">	<?php IF (isset($_SESSION['errors']['usernameError'])) {
				echo $_SESSION['errors']['usernameError'];
				} ?>
		</span><br>

		<label class="formheading" for="password"> Password: </label>
		<input type="password" name="password">  <!-- this needs to be encrypted on Submit --></input> 
		<?php IF (isset($_SESSION['errors']['passwordError']) && ($_SESSION['errors']['passwordError'] != '')) { ?>
			<span class="error"><?php	echo $_SESSION['errors']['passwordError']; ?></span>
			<?php } else { 	?>
				<span> &nbsp; Password must be at least 8 characters </span>
				<?php }?>
		<br>

		<input type="submit" value="Submit">
	</fieldset>
	</form>
	</div> <!-- loginformlayout -->

</div>  <!-- content -->

	<div class="footer">
		<?php include "footer.php" ?>
	</div>  <!-- footer -->
</div>  <!-- wrapper -->
</body>
</html>