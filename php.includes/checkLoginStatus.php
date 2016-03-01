<?php
	use Parse\ParseObject;
	use Parse\ParseUser;
	
	require 'initializeParseClient.php';	
	require 'php.classes/ParseConstants.php';
	require 'php.classes/User.php';

	use Parse\ParseQuery;
	use Parse\ParseACL;
	use Parse\ParsePush;
	use Parse\ParseInstallation;
	use Parse\ParseException;
	use Parse\ParseAnalytics;
	use Parse\ParseFile;
	use Parse\ParseCloud;

	//WARNING! if change one of these variables, change system wide
	$parse_current_user = ParseUser::getCurrentUser();
	if($parse_current_user){
		//both $parse_current_user_uid and $parse_current_user_id are used in system 
		$parse_current_user_uid = $parse_current_user->getObjectId();
		$parse_current_user_id = $parse_current_user_uid;
		$parse_current_user_u = $parse_current_user->get(ParseConstants::KEY_USERNAME);
		$parse_current_user_e = $parse_current_user->get(ParseConstants::KEY_EMAIL);

		include_once("php.includes/php.functions/parseCustomFunctions.php");
		include_once("php.classes/TimeAgo.php");
	}
?>