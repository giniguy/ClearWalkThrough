<?php
class Dao {
/* 	// connection for local database
private $host = "localhost";
private $db = "clearwalkthrough";
private $user = "root";
private $pass = "DB_login"; */

  // connection for heroku database
private $host = "us-cdbr-iron-east-04.cleardb.net";
private $db = "heroku_912aebf8b73e1cb";
private $user = "b318bad12b27a3";
private $pass = "9f921efe";


public function getConnection () {
	return new PDO("mysql:host={$this->host};dbname={$this->db}", $this->user, $this->pass);
}  //end getConnection

public function cleanText ($string) {
	$string = trim($string);
	$string = htmlspecialchars($string);
	return $string;
}

public function getUserByEMail ($email) {
	$conn = $this->getConnection();
	return $conn->query("SELECT * FROM users WHERE email = '$email'");
} // end getUserByEMail

public function getUserByUN ($username) {
	$conn = $this->getConnection();
	return $conn->query("SELECT * FROM users WHERE username = '$username'");
} // end getUserByUN

public function checkPassword ($username, $password) {
		// get user password from db
	$conn = $this->getConnection();
	$stored_password = $conn->query("SELECT password FROM users WHERE username = '$username'");
	foreach ($stored_password as $stored_pw) { 
		$hashed_pw = $stored_pw["password"];
		// check for password match
 	  if (password_verify($password, $hashed_pw)) {
		  $_SESSION['authenticated'] = true;
	  } else {
		$_SESSION['messages']['userInfo'] = "Incorrect username or password. Please try again.";	  
	  }
	}	// end foreach
} // end checkPassword

public function userExists ($email) {
	$count = 0;
	$conn = $this->getConnection();
	$users = $conn->query("SELECT * FROM users WHERE email = '$email'");
	foreach ($users as $user) { $count++; }
	if ($count != 0) {
		return true;
	}  // end foreach
} // end userExists

public function createUser ($username,$password,$firstname,$lastname,$email) {
	$conn = $this->getConnection();
	// hash password
		$pw = password_hash($password, PASSWORD_DEFAULT);
		if(!$pw) {
			throw new Exception("Password could not be hashed.");
		}
		// insert user into users table
	$query = 
		"INSERT INTO users (username, password, firstname, lastname, email)
			VALUES (:username, :password, :firstname, :lastname, :email)";
	$q = $conn->prepare($query);
	$q->bindParam(":username", $username);
	$q->bindParam(":password", $pw);
	$q->bindParam(":lastname", $lastname);
	$q->bindParam(":firstname", $firstname);
	$q->bindParam(":email", $email);
	$q->execute();
} // end createUser
	
public function assignRole($role, $email) {	// assign user roles
	$conn = $this->getConnection();
	$users = $this->getUserByEMail($email);
	foreach ($users as $user) { 
		$userID = $user["userID"];
		$query = "INSERT INTO user_role (user, role) VALUES (:user, :role)";
			$q = $conn->prepare($query);
			$q->bindParam(":user", $userID);
			$q->bindParam(":role", $role);
			$q->execute();			
	} // end foreach
} // end assignRole
	
public function updatePassword($email, $password) {
		$pw = password_hash($password, PASSWORD_DEFAULT);
		if(!$pw) {
			throw new Exception("Password could not be hashed.");
		}
	$conn = $this->getConnection();
	$query = "UPDATE users SET password = '$pw' WHERE email = '$email'";
	$q = $conn->prepare($query);
	$q->bindParam(":password", $pw);
	$q->execute();
} // end updatePassword

public function updateLastLogin($username) {
		$timestamp = date('Y-m-d G:i:s');
		$userID = $_SESSION['user']['userID'];
	$conn = $this->getConnection();
	$query = "UPDATE users SET last_login = '$timestamp' WHERE username = '$username'";
	$q = $conn->prepare($query);
	$q->bindParam(":last_login", $timestamp);
	$q->execute();
} // end updateLastLogin

public function getTchrObservation($userID) {
	$conn = $this->getConnection();
	return $conn->query("SELECT * FROM observations 
		JOIN users ON observer = userID 
		 WHERE teacher = '$userID'");			
} // end getTchrObservation

}  //end Dao
