<?php 
session_start();
require "../dao.php";

$dao = new dao();
// post variables
$submit = $_POST['comment_value'];
	$code = explode("-",$submit);
	$commentID = $code[0];
	$value = $code[1];
$time = time();

// calculate time of comment
	$seconds = $time - $_SESSION['recording']['startTime'];
		$commentTime = $dao -> secondsToTime($seconds);

if($commentID=="0") { 
// freeform comment
$commentText = $_POST['comment_text'];
	// insert full text of comment into freeform_comments table
		$dao -> insertFreeformComment($_SESSION['recording']['obsID'], $commentText, $commentTime);
	} else { 
	   
// not freeform comment
	// add comment value 
			$_SESSION['recording']['commentTotal'] = $_SESSION['recording']['commentTotal'] + $value;
	// increase comment count	
			$_SESSION['recording']['commentCount']++;
		$dao -> insertObservationComment($_SESSION['recording']['obsID'], $commentID, $commentTime);
	}	
	
	
		// return to observation recording page
	header("Location:../obs_recorder.php");
	