<?php 
session_start();
require "../dao.php";

$dao = new dao();
// post variables
$commentID = $_POST['commentID'];
$value = $_POST['comment_value'];
$time = time();


// calculate time of comment
	$seconds = $time - $_SESSION['recording']['startTime'];
		$commentTime = $dao -> secondsToTime($seconds);

// add comment value
	$_SESSION['recording']['commentTotal'] = $_SESSION['recording']['commentTotal'] + $value;

// increase comment count	
	$_SESSION['recording']['commentCount']++;

	$dao -> insertObservationComment($_SESSION['recording']['obsID'], $commentID, $commentTime);
	
		// return to observation recording page
	header("Location:../obs_recorder.php");
	