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

	//function used sitewide
	function getPhotoCommentsById($photoObjectId){
		$comments_query = new ParseQuery(ParseConstants::CLASS_COMMENTS);
		$comments_query->equalTo(ParseConstants::KEY_PHOTO_ID, $photoObjectId);
		return $comments_query->find();
	}
	function getPhotoCommentsCountById($photoObjectId){
		$count_query = new ParseQuery(ParseConstants::CLASS_COMMENTS);
		$count_query->equalTo(ParseConstants::KEY_PHOTO_ID, $photoObjectId);
		$count = count($count_query->find());
		return $count;
	}
	function getPhotoLikesCountById($photoObjectId){
		$image_likes_query = new ParseQuery(ParseConstants::CLASS_LIKES);
		$image_likes_query->equalTo(ParseConstants::KEY_PHOTO_ID, $photoObjectId);
		$image_likes_count = count($image_likes_query->find());
		return $image_likes_count;
	}
	function userAlreadyLikedPhoto($userObjectId, $photoObjectId){
		$image_current_user_liked_query = new ParseQuery(ParseConstants::CLASS_LIKES);
		$image_current_user_liked_query->equalTo(ParseConstants::KEY_PHOTO_ID, $photoObjectId);
		$image_current_user_liked_query->equalTo(ParseConstants::KEY_USER_ID, $userObjectId);
		$image_current_user_liked_count = count($image_current_user_liked_query->find());
		if($image_current_user_liked_count>0){
			return true;
		} else {return false;}
	}
	function getParseUserFromId($userObjectId){
		$parse_user_query = ParseUser::query();
		try {
			$parse_user = $parse_user_query->get($userObjectId);
		} catch (ParseException $ex) {
		  // The object was not retrieved successfully.
		  // error is a ParseException with an error code and message.
		}
		return $parse_user;
	}
	function getParseUserFriendsFromId($userObjectId){
		//get the user object
		$parse_user = getParseUserFromId($userObjectId);

		$parse_relation = $parse_user->getRelation(ParseConstants::KEY_FRIENDS_RELATION);
		$parse_user_friends = $parse_relation->getQuery()->find();

		return $parse_user_friends;
	}

	function getParseUserFriendFromId($user1ObjectId, $user2ObjectId){
		//get the user object
		$parse_user = getParseUserFromId($user1ObjectId);
		if($parse_user){
			$parse_relation = $parse_user->getRelation(ParseConstants::KEY_FRIENDS_RELATION);
			$parse_user_friends = $parse_relation->getQuery()->find();
			for($i=0; $i<count($parse_user_friends); $i++){
				$parse_user_friend = $parse_user_friends[$i];
				$parse_user_friend_uid = $parse_user_friends[$i]->getObjectId();
				if( $parse_user_friend_uid == $user2ObjectId ) {
					$parse_user_friend_return = $parse_user_friend;
				}

			}
		}

		return $parse_user_friend_return;
	}

	function mutualFriendsCount($user1ObjectId, $user2ObjectId){
		$mutual_friends_count = 0;

		$parse_user1 = getParseUserFromId($user1ObjectId);
		//get user1 friends
		$parse_user1_friends = getParseUserFriendsFromId($user1ObjectId);
		//get user2
		$parse_user2 = getParseUserFromId($user2ObjectId);
		//get user2 friends
		$parse_user2_friends = getParseUserFriendsFromId($user2ObjectId);
		for($i=0; $i<count($parse_user1_friends); $i++){
			$parse_user1_friend_uid = $parse_user1_friends[$i]->getObjectId();
			for ($j=0; $j < count($parse_user2_friends); $j++) { 
				$parse_user2_friend_uid = $parse_user2_friends[$j]->getObjectId();
				if( $parse_user1_friend_uid == $parse_user2_friend_uid ) {
					$mutual_friends_count +=1;
				}
			}
		}
		return $mutual_friends_count;
	}

	function isFriend($user1ObjectId, $user2ObjectId){
		$parse_user1 = getParseUserFromId($user1ObjectId);
		//get user1 friend with the provided user
		$parse_user1_friend = getParseUserFriendFromId($user1ObjectId, $user2ObjectId);
		if($parse_user1_friend){
			$parse_user1_friend_uid = $parse_user1_friend->getObjectId();
			if( $user2ObjectId == $parse_user1_friend_uid){
				//user1 has user2 has a friend
				return true;
			} else { return false; }
		} else {
			return false;
		}
	}

	function areTruFriends($user1ObjectId, $user2ObjectId){
		if( isFriend($user1ObjectId, $user2ObjectId) && isFriend($user2ObjectId, $user1ObjectId) ){
			//both users have one another as a friend, so they are TruFriends
			return true;
		} else {
			return false;
		}
	}

	function createRecipientDisplay($uid, $u, $url){
		$recipient_diplay = '<div id="recipient'.$uid.'" class="chat-msg">';
			$recipient_diplay .= '<div class="col-xs-2 chat-people">';
				$recipient_diplay .= '<a href="#"><img style="width:60px; height:60px; border-radius:100%" src="'.$url.'" title="name" /></a>';
			$recipient_diplay .= '</div>';
			$recipient_diplay .= '<div class="col-xs-9 chat-msg-on">';
				$recipient_diplay .= '<p>';
					$recipient_diplay .= ''.$u.'';
				$recipient_diplay .= '</p>';
				$recipient_diplay .= '<span> </span>';
			$recipient_diplay .= '</div>';
			$recipient_diplay .= '<div class="clearfix"> </div>';
		$recipient_diplay .= '</div>';

		return $recipient_diplay;
	}

	function createOutBoxRecipientDisplay($uid, $u, $url){
		$recipient_diplay = '<div id="recipient'.$uid.'" class="display_inline_block padding_5px">';
				$recipient_diplay .= '<a href="#"><img style="width:24px; height:24px; border-radius:100%" src="'.$url.'" title="'.$u.'" /></a>';
		$recipient_diplay .= '</div>';

		return $recipient_diplay;
	}
?>