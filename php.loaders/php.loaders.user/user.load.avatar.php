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


	$parse_current_user = ParseUser::getCurrentUser();
	$parse_current_user_id = $parse_current_user->getObjectId();
	$parse_user_avatar_url = getParseUserAvatarUrl($parse_current_user_id);
	//function used sitewide
	function getParseUserAvatarUrl($userObjectId){
		$parse_user_avatar_query = new ParseQuery(ParseConstants::CLASS_USER_IMAGES);
		$parse_user_avatar_query->limit(2);
		$parse_user_avatar_query->descending(ParseConstants::KEY_CREATED_AT);
		$parse_user_avatar_query->equalTo(ParseConstants::KEY_IMAGETITLE, "avatar".$userObjectId);
		$parse_user_images = $parse_user_avatar_query->find();
		for ($i = 0; $i < count($parse_user_images); $i++) {
			//get the first one
			$parse_user_avatar = $parse_user_images[0];
			$parse_user_avatar_url = $parse_user_avatar->get(ParseConstants::KEY_IMAGEURL);
		}

		if($parse_user_avatar_url) {
			return $parse_user_avatar_url;
		} else {
			return "images/avatar.empty.png";
		}
	}
?>