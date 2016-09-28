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
	<div class="loginformlayout">
	<form method="POST" action="retrieve_un.php">
		<p> Forgot your username? <br> Enter your email below. <br> An email will be sent to you with login information.
		</p> <br>
		<label> Email address: 
		</label>
		<input id="email" name="email"> 
		</input> <br>
		<label> </label>
		<input type="submit" value="Submit">
	</form>
	</div> <!-- loginformlayout -->

	<div class="loginoptionlayout">
		<label> Don't have an account?
		</label>
			<div class="columnright"> <a href="signup.php"> Click here to sign up </a>
			</div> <br>
		<label> Trouble logging in? 
		</label>
			<div class="columnright"> <a href="lost_un.php"> Forgot user name </a>
			</div> <br>
		<label> </label>
			<div class="columnright">
				<a href="lost_pw.php"> Forgot password </a>
			</div>
	</div> <!-- loginoptionlayout -->
</div>  <!-- content -->

	<div class="footer">
		<?php require_once "footer.php" 
		?>
	</div>  <!-- footer -->
</div>  <!-- wrapper -->
</body>
</html>