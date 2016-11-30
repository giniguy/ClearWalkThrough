<?php
class Dao {

/* 	// connection to localhost
private $host = "localhost";
private $db = "ClearWalkThrough";
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

public function getUserByID ($userID) {
	$conn = $this->getConnection();
	return $conn->query("SELECT * FROM users WHERE userID = '$userID'");
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
		$xID = uniqid();
	// insert user into users table
	$query = 
		"INSERT INTO users (xternalID, username, password, firstname, lastname, email)
			VALUES (:xternalID, :username, :password, :firstname, :lastname, :email)";
	$q = $conn->prepare($query);
	$q->bindParam(":xternalID", $xID);
	$q->bindParam(":username", $username);
	$q->bindParam(":password", $pw);
	$q->bindParam(":lastname", $lastname);
	$q->bindParam(":firstname", $firstname);
	$q->bindParam(":email", $email);
	$q->execute();
} // end createUser
	
public function assignRole($roleID, $email) {	// assign user roles
	$conn = $this->getConnection();
	$users = $this->getUserByEMail($email);
	foreach ($users as $user) { 
		$userID = $user["userID"];
		$query = "INSERT INTO user_role (userID, roleID) VALUES (:userID, :roleID)";
			$q = $conn->prepare($query);
			$q->bindParam(":userID", $userID);
			$q->bindParam(":roleID", $roleID);
			$q->execute();			
	} // end foreach
} // end assignRole
	
public function updatePassword($xID, $password) {
		$pw = password_hash($password, PASSWORD_DEFAULT);
		if(!$pw) {
			throw new Exception("Password could not be hashed.");
		}
	$conn = $this->getConnection();
	$query = "UPDATE users SET password = '$pw' WHERE xternalID = '$xID'";
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

public function getObsvrObservation($userID) {
	$conn = $this->getConnection();
	return $conn->query("SELECT * FROM observations 
		JOIN users ON teacher = userID 
		 WHERE observer = '$userID'");			
} // end getObsvrObservation

public function getTeachers($userID) {
	$conn = $this->getConnection();
	return $conn->query("SELECT * FROM users
		JOIN user_role ON users.userID = user_role.userID
			WHERE user_role.roleID = '1' AND user_role.userID != '$userID'");
}  // end getTeachers

public function getDomains() {
	$conn = $this->getConnection();
	return $conn->query("SELECT * FROM domains");
}  // end getDomains

public function getBehaviors($domainID) {
	$conn = $this->getConnection();
	return $conn->query("SELECT * FROM behaviors WHERE domainID = '$domainID'");
}  // end getBehaviors

public function getComments($behaviorID) {
	$conn = $this->getConnection();
	return $conn->query("SELECT * FROM comments 
		JOIN ratings ON comments.ratingID = ratings.ratingID
			WHERE comments.behaviorID = '$behaviorID'
				ORDER BY ratings.value DESC;");
}  // end getComments

public function createObservation($obsDate, $teacher, $observer, $classPeriod) {
	$conn = $this->getConnection();
	$xternalID = uniqid();
	// insert observation details into observations table
	$query = 
		"INSERT INTO observations (xternalID, obsDate, teacher, observer, classPeriod)
			VALUES (:xternalID, :obsDate, :teacher, :observer, :classPeriod)";
	$q = $conn->prepare($query);
	$q->bindParam(":xternalID", $xternalID);
	$q->bindParam(":obsDate", $obsDate);
	$q->bindParam(":teacher", $teacher);
	$q->bindParam(":observer", $observer);
	$q->bindParam(":classPeriod", $classPeriod);
	$q->execute();
}  // end createObservation

public function getObsID($obsDate, $teacher, $observer, $classPeriod) {
	$conn = $this->getConnection();
	return $conn->query("SELECT * FROM observations WHERE obsDate='$obsDate' AND teacher='$teacher' AND observer='$observer' AND classPeriod='$classPeriod'");
}  // end getObsID

public function endObservation($obsID) {
		$obsLength = $_SESSION['recording']['elapsedTime'];
		$rating = $_SESSION['recording']['rating'];
		$videofile = $_SESSION['recording']['videofile'];
	$conn = $this->getConnection();
	$query = "UPDATE observations  
		SET obsLength = '$obsLength', rating = '$rating', videofile = '$videofile' 
		WHERE xternalID = '$obsID'";
	$q = $conn->prepare($query);
	$q->bindParam(":obsLength", $_SESSION['recording']['elapsedTime']);
	$q->bindParam(":rating", $_SESSION['recording']['rating']);
	$q->bindParam(":videofile", $_SESSION['recording']['videofile']);
	$q->execute();
} // end endObservation

function secondsToTime($seconds)
{
    $hours = floor($seconds / 3600);
    $seconds -= $hours * 3600;
    $minutes = floor($seconds / 60);
    $seconds -= $minutes * 60;
    return $hours.':'.sprintf('%02d', $minutes).':'.sprintf('%02d', $seconds);
}

public function insertObservationComment($obsXID, $commentID, $time) {
		$conn = $this->getConnection();
	// insert selected comment into observation_comments table
	$query = 
		"INSERT INTO observation_comments (obsXID, commentID, time)
			VALUES (:obsXID, :commentID, :time)";
	$q = $conn->prepare($query);
	$q->bindParam(":obsXID", $obsXID);
	$q->bindParam(":commentID", $commentID);
	$q->bindParam(":time", $time);
	$q->execute();
} // end insert observation comment

}  //end Dao
