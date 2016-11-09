<?php
session_start();
 if (!isset($_SESSION['presets'])) {
	$_SESSION['presets'] = array('firstname' => "",
							'lastname' => "",
							'email' => "",
							'email2' => "",
							'username' => ""
							);
 } 
 if (!isset($_SESSION['errors'])) {
	$_SESSION['errors'] = array('firstnameError' => "",
							'lastnameError' => "",
							'emailError' => "",
							'email2Error' => "",
							'usernameError' => "",
							'passwordError' => ""
							);
 } 
 if (!isset($_SESSION['messages'])) {
	$_SESSION['messages'] = array('userInfo' => "",
							'emailNotFound' => ""
							);
 } 
 if (isset($_SESSION['authenticated']) && $_SESSION['authenticated']) {
	 header("Location:dashboard.php");
 }
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
	  <div class="message"><?php echo $_SESSION['messages']['userInfo']; 
		// clear userInfo message
	  $_SESSION['messages']['userInfo'] = '';?>
	  </div>
	
	<form method="POST" action="handlers/login_handler.php">
	  <fieldset>
		<label class="formheading" for="username"> User Name: </label>
		<input type="text" id="username" name="username" autofocus> </input> <br>
		<label class="formheading" for="password"> Password: </label>
		<input type="password" id="password" name="password"> 
		</input> <br>
		<input type="submit" value="Login">
	  </fieldset>
	</form>
	</div> <!-- loginform -->
	<fieldset>
		<label class="formheading"> Don't have an account? </label>
			<label class="columnright"> <a href="signup.php"> Click here to sign up </a>
			</label> <br>
		<label class="formheading"> Trouble logging in? </label>
			<label class="columnright"> <a href="login_reset.php"> Click here for help </a>
	</div> <!-- loginoptionlayout -->
</div>  <!-- content -->

	<div class="footer">
		<?php require_once "footer.php" 
		?>
	</div>  <!-- footer -->
</div>  <!-- wrapper -->
</body>
</html>