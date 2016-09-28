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
	<div class="loginformlayout">
	<form method="POST" action="create_user.php">
		<label> First Name: 
		</label>
		<input id="firstname" name="firstname"> 
		</input> <br>
		<label> Last Name: 
		</label>
		<input id="lastname" name="lastname">  <!-- encrypt on Submit -->
		</input> <br>
		<label> Email Address: 
		</label>
		<input id="email1" name="email1"> <!-- validate email format is correct and not in use on Submit -->
		</input> <br>
		<label> Verify Email Address: 
		</label>
		<input id="email2" name="email2">  <!-- validate match on Submit -->
		</input> <br>
		<label> User Name: 
		</label>
		<input id="username" name="username"> 
		</input> <br>
		<label> Password: 
		</label>
		<input type="password" name="password">  <!-- this needs to be encrypted on Submit -->
		</input> <br>
		<label> </label>
		<input type="submit" value="Submit">
	</form>
	</div> <!-- loginformlayout -->

</div>  <!-- content -->

	<div class="footer">
		<?php include "footer.php" ?>
	</div>  <!-- footer -->
</div>  <!-- wrapper -->
</body>
</html>