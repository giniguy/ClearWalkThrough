<?php
session_start();
require "../dao.php";
unset($_SESSION['errors']);
$errors = false;
$dao = new dao;

// create a user from form entry
// extract variables from form and check for valid entries
$role = $_POST['role'];
$firstname = $_POST['firstname'];
	$firstname = $dao -> cleanText($firstname);
	($firstname == '') ? (($firstnameError = 'First name is required') && ($errors = true)) : $firstnameError = '';
$lastname = $_POST['lastname'];
	$lastname = $dao -> cleanText($lastname);
	($lastname == '') ? (($lastnameError = 'Last name is required') && ($errors = true)) : $lastnameError = '';
$email = $_POST['email'];
	$email = $dao -> cleanText($email);
	(!filter_var($email, FILTER_VALIDATE_EMAIL)) ? (($emailError = 'Invalid Email') && ($errors = true)) : $emailError = '';
$email2 = $_POST['email2'];
	$email2 = $dao -> cleanText($email2);
	(!($email2 === $email)) ? (($email2Error = 'Email addresses do not match') && ($errors = true)) : $email2Error = '';
$username = $_POST['username'];
	$username = $dao -> cleanText($username);
	($username == '') ? (($usernameError = 'Username is required') && ($errors = true)) : $usernameError = '';
$password = $_POST['password'];
	$password = $dao -> cleanText($password);
	(!preg_match("/.{8,}/", $password)) ? (($passwordError = 'Password must be at least 8 characters') && ($errors = true)) : $passwordError = '';

// assign values to session variables
$_SESSION['presets'] = array('firstname' => $firstname,
							'lastname' => $lastname,
							'email' => $email,
							'email2' => $email2,
							'username' => $username
							);

IF ($errors)	{
	$_SESSION['errors'] = array('firstnameError' => $firstnameError,
							'lastnameError' => $lastnameError,
							'emailError' => $emailError,
							'email2Error' => $email2Error,
							'usernameError' => $usernameError,
							'passwordError' => $passwordError
							);

	header("Location:../signup.php");	
} else {
	// form entries valid; check for existing user
	$dao = new dao();
	$exists = $dao -> userExists($email);
		if ($exists) {  // set error message and return to signup page
			$userError = "A user with this email already exists.";
			$_SESSION['errors']['emailError'] = $userError;
		header("Location:../signup.php");			
		} else {
		// create user in database and assign role
		$dao ->	createUser ($username,$password,$firstname,$lastname,$email);
		$dao -> assignRole ($role, $email);
				// check for teacher role and add observer role also
			if ($role == 1) {
				$role = 2;
				$dao -> assignRole ($role, $email);
			}
		unset($_SESSION['presets']);
		$_SESSION['messages']['userInfo'] = "Your account has been created. Please login.";
		header("Location:../index.php");
} // end create user
} // end existing user check
					
