<?php
session_start();
?>
<html>
<head>
	<title>Account Sign Up</title>
	<link href="cwtstyle.css" type="text/css" rel="stylesheet" />
	<link href="favicon.ico" type="image/gif" rel="icon" />
	<script src="js/jquery.min.js"></script>
	<script src="js/guardian/js/jquery.guardian-1.0.min.js"></script>
	<link href="js/guardian/css/guardian.css" rel="stylesheet">
</head>

<body>
<script>
<!-- initialize Guardian plugin -->
$(document).ready(function() {
    $('#signup_form').guardian();
});
</script>

<div class="wrapper">
<div class="header">
	<img src="images/CWT-banner.png" />	
</div> <!-- header -->

<div class="content">
	<div>
	<fieldset>
	Enter information for your account below. </br>All fields are required.</br></br>
	 <form id="signup_form" method="POST" action="handlers/signup_handler.php">
	 	<label class="formheading" for="role"> Account Type: </label>
			<select name="role">
				<option value = 1 selected>Teacher</option>
				<option value = 2>Observer</option>
			</select>
		<br>
		<label class="formheading" for="firstname"> First Name: </label>
		<input type="text" id="firstname" name="firstname" value="<?php echo $_SESSION['presets']['firstname'] ?>" 
				autofocus required="required" data-empty-message=" &nbsp; Please enter your first name."> </input>
		<span class="error">	<?php IF (isset($_SESSION['errors']['firstnameError'])) {
				echo $_SESSION['errors']['firstnameError'];
				} ?>
		</span><br>
		
		<label class="formheading" for="lastname"> Last Name: </label>
		<input type="text" id="lastname" name="lastname" value="<?php echo $_SESSION['presets']['lastname'] ?>" 
				required="required" data-empty-message=" &nbsp; Please enter your last name."> </input>
		<span class="error">	<?php IF (isset($_SESSION['errors']['lastnameError'])) {
				echo $_SESSION['errors']['lastnameError'];
				} ?>
		</span><br>

		<label class="formheading" for="email"> Email Address: </label>
		<input id="email" type="email" name="email" value="<?php echo $_SESSION['presets']['email'] ?>"
				required="required" data-empty-message=" &nbsp; Please enter your email." 
				data-error-message=" &nbsp; Email is not valid. Please re-enter." 
				data-pattern="email"> </input> 
				<span class="error">	<?php IF (isset($_SESSION['errors']['emailError'])) {
				echo $_SESSION['errors']['emailError'];
				} ?>
		</span><br>

		<label class="formheading" for="email2"> Verify Email Address: </label>
		<input id="email2" type="email" name="email2" value="<?php echo $_SESSION['presets']['email2'] ?>"
				required="required" data-empty-message=" Please re-enter your email." 
				data-pattern="match" data-match-input="email" data-error-message=" &nbsp; Emails do not match. Please re-enter."> </input> 
		<span class="error">	<?php IF (isset($_SESSION['errors']['email2Error'])) {
				echo $_SESSION['errors']['email2Error'];
				} ?>
		</span><br>

		<label class="formheading" for="username"> User Name: </label>
		<input id="username" name="username" value="<?php echo $_SESSION['presets']['username'] ?>"
				required="required" data-empty-message=" &nbsp; Please enter a username."> </input>
		<span class="error">	<?php IF (isset($_SESSION['errors']['usernameError'])) {
				echo $_SESSION['errors']['usernameError'];
				} ?>
		</span><br>

		<label class="formheading" for="password"> Password: </label>
		<input id="password" type="password" name="password"> </input> 
		<?php IF (isset($_SESSION['errors']['passwordError']) && ($_SESSION['errors']['passwordError'] != '')) { ?>
			<span class="error"><?php	echo $_SESSION['errors']['passwordError']; ?></span>
			<?php } else { 	?>
				<span> &nbsp; Password must be at least 8 characters </span>
				<?php }?>
		<br>

		<input type="submit" value="Submit"></input>
	</fieldset>
	</form> 
<script>   <!-- vaildate form with Guardian jQuery plugin -->
	$("#signup_form").validate({
		rules: {
			firstname: {required: true },
			lastname: {required: true },
			email: {required: true,
					email: true },
			email2: {required: true,
					equalTo: "#email" }
			username: {required: true },
			password: {required: true,
					minlength: 8 }
		},
		messages: {
			firstname: {required: "First name is required" },
			lastname: {required: "Last name is required" },
			email: {required: "Enter a valid email" },
			email2: {required: "Verify email by entering again",
				equalTo: "Email addresses must match" },
			username: {required: "A username is required" },
			password: {required: "A password is required",
				minlength: "Password must be at least 8 characters"}
		}
});
</script>
	<fieldset>
		<a href="index.php"> Back to login </a>
	</fieldset>
	</div> <!-- loginformlayout -->

</div>  <!-- content -->

	<div class="footer">
		<?php include "footer.php" ?>
	</div>  <!-- footer -->
</div>  <!-- wrapper -->
</body>
</html>