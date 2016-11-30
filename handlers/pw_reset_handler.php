<?php
// send email with username and link to reset password then

session_start();
require "../dao.php";
$xID = $_GET['ID'];
$errors = false;
$dao = new dao();

//clear presets email
//	$_SESSION['presets']['email'] = '';


// check new password length
$password = $_POST['password'];
	$password = $dao -> cleanText($password);
	(!preg_match("/.{8,}/", $password)) ? (($passwordError = 'Password must be at least 8 characters') && ($errors = true)) : $passwordError = '';
// bad password; retry
	IF ($errors)	{
	$_SESSION['errors']['passwordError'] = $passwordError;
	header("Location:../pw_reset.php?ID=$xID");
	} else {
// check passwords match
$password2 = $_POST['password2'];
	$password2 = $dao -> cleanText($password2);
	(!($password2 === $password)) ? (($passwordError = 'Passwords must match') && ($errors = true)) : $passwordError = '';
	} // password error; retry
	IF ($errors)	{
	$_SESSION['errors']['passwordError'] = $passwordError;
	header("Location:../pw_reset.php?ID=$xID");
} else {
  // good password; update user password 
		$dao -> updatePassword($xID, $password);
			  $_SESSION['messages']['userInfo'] = 'Your password has been reset. Please login.';
		header("Location:../index.php");
} // end else
