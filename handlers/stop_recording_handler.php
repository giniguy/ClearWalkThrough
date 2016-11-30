<?php 
session_start();
require "../dao.php";

$dao = new dao();
// calculate length of observation
	$_SESSION['recording']['stopTime'] = time();
	$seconds = $_SESSION['recording']['stopTime'] - $_SESSION['recording']['startTime'];
		$_SESSION['recording']['elapsedTime'] = $dao -> secondsToTime($seconds);

// calculate observation rating
	$rating = $_SESSION['recording']['commentTotal'] / $_SESSION['recording']['commentCount'];
	$rndRating = (round($rating * 2, 0))/2;
	$_SESSION['recording']['rating'] = $rndRating;
	
// generate video file name
	$_SESSION['recording']['videofile'] = $_SESSION['recording']['obsID'].".mp4";

// finalize observation record in db
	$dao -> endObservation($_SESSION['recording']['obsID']);
	
// unset session recording variables
	unset($_SESSION['recording']);
	
// return to dashboard
	header("Location:../dashboard.php");	

