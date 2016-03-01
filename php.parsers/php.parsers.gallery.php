<?php
use Parse\ParseObject;
use Parse\ParseUser;
use Parse\ParseQuery;
use Parse\ParseACL;
use Parse\ParsePush;
use Parse\ParseInstallation;
use Parse\ParseException;
use Parse\ParseAnalytics;
use Parse\ParseFile;
use Parse\ParseCloud;
?><?php 
include 'php.includes/checkLoginStatus.php';
include_once("php.classes/User.php");

$parse_current_user = ParseUser::getCurrentUser();
$current_user_id = $parse_current_user->getObjectId();
?><?php
	if( ( isset($_POST["photo_comment"]) && isset($_POST["photo_id"])) ){
		//GET POST or GET VARIABLES depending on origins of the action
		$photo_id = $_POST['photo_id'];
		$photo_comment = $_POST['photo_comment'];
		
		// END FORM DATA ERROR HANDLING
		$comment = new ParseObject("Comments");
		$comment->set("comment", $photo_comment);
		$comment->set(ParseConstants::KEY_PHOTO_ID, $photo_id);
		$comment->set(ParseConstants::KEY_USER_ID, $current_user_id);	 
		try {
		  $comment->save();
		  // Hooray! Let them use the app now.
		  echo "success";
		} catch (ParseException $ex) {
		  // Show the error message somewhere and let the user try again.
		  echo $ex->getMessage();
		  exit();
		}
		exit();
			
	} else if( (isset($_POST["photo_like"]) && isset($_POST["photo_id"])) ){
		//GET POST or GET VARIABLES depending on origins of the action
		$photo_id = $_POST['photo_id'];
		
		$like = new ParseObject("Likes");
		$like->set(ParseConstants::KEY_PHOTO_ID, $photo_id);
		$like->set(ParseConstants::KEY_USER_ID, $uid);	 
		try {
		  $like->save();
		  // Hooray! Let them use the app now.
		  echo "success";
		} catch (ParseException $ex) {
		  // Show the error message somewhere and let the user try again.
		  echo $ex->getMessage();
		  exit();
		}
		exit();
	}
?>