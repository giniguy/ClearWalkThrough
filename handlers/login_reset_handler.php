<?php
// send email with username and link to reset password

session_start();
require "../dao.php";

// email from login_reset form
$email = $_POST['email'];

$_SESSION['presets']['email'] = $email;
$dao = new dao();

// check to see if user exists
$exists = $dao -> userExists($email);
if ($exists) {

		// get user info from db
		$users = $dao -> getUserByEMail($email);
		foreach ($users as $user) {
			$firstname = $user["firstname"];
			$lastname = $user["lastname"];
			$username = $user["username"];
			$ID = $user["xternalID"];
			$to = $user["email"];
			$subject = 'ClearWalkThrough Login Help';
			$headers = 'From: gini.guy@idla.k12.id.us' . "\r\n" .
				'Reply-To: webmaster@example.com' . "\r\n" .
				'X-Mailer: PHP/' . phpversion();
			$message = "Hello $firstname $lastname, <br>
				Someone has requested help with the ClearWalkThrough login associated with this email.<br>
				If it was not you, just ignore this email and do nothing. Your account is secure.<br>
				If you did request assistance, you can login using <strong>$username</strong> as your username. <br>
				If you have forgotten your password,  
				<a href='../pw_reset.php?ID=$ID'>click here to reset it.</a><br>
				Good luck!";
		// send email
		echo $message;
	//	mail($to, $subject, $message, $headers);
	//		$_SESSION['messages']['userInfo'] = "An email has been sent with information to assist you in logging in.";
			$_SESSION['presets']['email'] = '';
	//		header("Location:../index.php");
		} // end foreach user
//	} // end foreach email
} else {
	// user doesn't exist 
	$_SESSION['messages']['emailNotFound'] = "No user associated with this email.";
	header("Location:../login_reset.php");
}
