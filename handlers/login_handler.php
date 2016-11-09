<?php 
session_start();
require "../dao.php";

// post variables 
$username = $_POST['username'];
$password = $_POST['password'];
// declare variables
$_SESSION['authenticated'] = false;

$dao = new dao();
	// check credentials
	$dao -> checkPassword($username, $password);
	if ($_SESSION['authenticated']) {
		$dao -> updateLastLogin($username);
		$userDetails = $dao -> getUserByUN($username);
		foreach ($userDetails as $user) {
		 // get user details and assign to session variables
		$_SESSION['user']['userID'] = $user["userID"];
		$_SESSION['user']['firstname'] = $user["firstname"];
		$_SESSION['user']['lastname'] = $user["lastname"];
		$_SESSION['user']['username'] = $user["username"];
		$_SESSION['user']['email'] = $user["email"];
		$_SESSION['user']['last_login'] = $user["last_login"];
		$_SESSION['user']['num_logins'] = $user["num_logins"];
		header("Location:../dashboard.php");
		} // end foreach
	} else { 
		// return to login page
		header("Location:../index.php");
	}

