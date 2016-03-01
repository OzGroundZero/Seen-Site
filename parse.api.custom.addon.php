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
?><?php

if( isset($_POST["action"]) ){
  //GET POST or GET VARIABLES depending on origins of the action
	if( isset($_POST["action"]) && $_POST["action"] == "delete_message" ){
		$message_id = $_POST["message_id"];
		$message_query = new ParseQuery(ParseConstants::CLASS_MESSAGES);
		try{
			$parse_message = $message_query->get($message_id);
		} catch (ParseException $ex) {
			echo "action_failed | Something went wrong while trying to destroy the message.";
			exit;
		}
		if($parse_message){
			if( $parse_message->get(ParseConstants::KEY_SENDER_ID) == $parse_current_user_uid ){
				$parse_message->destroy();
				echo "action_success | Message Successfully Deleted!<br><br>Nobody will be able to see it again.";
			} else {
				echo "action_failed | Awkward... Message doesn't belong to you.";
			}
			exit;
		} else {
			echo "action_failed | Message no longer exists.";
			exit;			
		}
	} else if( isset($_POST["action"]) && $_POST["action"] == "hide_message" ){
		$message_id = $_POST["message_id"];
		$message_query = new ParseQuery(ParseConstants::CLASS_MESSAGES);
		try{
			$parse_message = $message_query->get($message_id);
		} catch (ParseException $ex) {
			echo "action_failed | Something went wrong while trying to hide the message.";
			exit;
		}
		$parse_message_hiders = $parse_message->get(ParseConstants::KEY_HIDER_IDS);
		$parse_message_new_hiders = array($parse_current_user->getObjectId());
		if($parse_message_hiders){
			for($j=0; $j<count($parse_message_hiders); $j++){
				$parse_message_hider = $parse_message_hiders[$j];
				if($parse_message_hider){
					array_push($parse_message_new_hiders, $parse_message_hider->getObjectId());
				}
			}
		}
		if($parse_message){
			$parse_message->setArray(ParseConstants::KEY_HIDER_IDS, $parse_message_new_hiders);
			$parse_message->save();
			echo "action_success | Message Successfully Hidden!<br><br>You won't see it again.";
			exit;
		} else {
			echo "action_failed | Message no longer exists.";
			exit;
		}
	} else if( isset($_POST["action"]) && $_POST["action"] == "search_users" ){
		$search_term = $_POST["search_term"];

		$parse_user_query = ParseUser::query();
		$parse_user_results = $parse_user_query->find();
		if($parse_user_results){
			for ($j = 0; $j < count($parse_user_results); $j++) {
				$parse_user_result = $parse_user_results[$j];

				if($parse_user_result){
					$parse_user_result_uid = $parse_user_result->getObjectId();
					$parse_user_result_u = $parse_user_result->get(ParseConstants::KEY_USERNAME);

					if( ( strpos($parse_user_result_u, $search_term) !== false && strlen($search_term)>2 ) && $parse_user_result_u != $parse_current_user_u){
						$parse_user_result_avatar_url = getParseUserAvatarUrl($parse_user_result_uid);
						
						//set up friend display
						if( areTruFriends($parse_current_user_uid, $parse_user_result_uid) ){
							$parse_user_result_display = '<div id="userResult'.$parse_user_result_uid.'" 
														class="100_wide padding_20px border_bottom_1px_f0f0f0 
														hover_background_turquoise hover_text_color_white
														background_color_blue text_color_white">';
						} else {
							$parse_user_result_display = '<div id="userResult'.$parse_user_result_uid.'" 
														class="100_wide padding_20px border_bottom_1px_f0f0f0 
														hover_background_turquoise hover_text_color_white">';
						}
							//user info preview
							$parse_user_result_display .= '<div class="display_inline_block">';
								$parse_user_result_display .= '<div class="100_wide">';
									$parse_user_result_display .= '<div class="display_inline_block">';
										$parse_user_result_display .= '<div class="float_left" style="padding-right:10px">';
											$parse_user_result_display .= '<img style="width:48px; height:48px" src="'.$parse_user_result_avatar_url.'"/>';
										$parse_user_result_display .= '</div>';
									$parse_user_result_display .= '</div>';
									$parse_user_result_display .= '<div class="display_inline_block">';
										$parse_user_result_display .= '<div class="float_left">';
											$parse_user_result_display .= '<b class="text_size_18px">'.$parse_user_result_u.'</b>';
										$parse_user_result_display .= '</div>';
										$parse_user_result_display .= '<div class="float_right">';
											$parse_user_result_display .= '<img id="searchFriendship'.$parse_user_result_uid.'" class="a_button"';
											if(isFriend($parse_current_user_uid, $parse_user_result_uid)){
												$parse_user_result_display.= ' src="images/design.android.material/ic_remove_circle_outline_24px.svg" alt="Text" ';
											} else {
												$parse_user_result_display.= ' src="images/design.android.material/ic_add_circle_outline_24px.svg" alt="Text" ';
											}
											$parse_user_result_display.= 'onclick="toggleFriendship(\''.$parse_user_result_uid.'\', \'searchFriendship'.$parse_user_result_uid.'\');">';
										$parse_user_result_display .= '</div>';
									$parse_user_result_display .= '</div>';
								$parse_user_result_display .= '</div>';
							$parse_user_result_display .= '</div>';
							$parse_user_result_display .= '<div class="100_wide">';
								$parse_user_result_display .= mutualFriendsCount($parse_current_user_uid, $parse_user_result_uid).' mutual TruFriends';
							$parse_user_result_display .= '</div>';
						$parse_user_result_display .= '</div>';

						$parse_user_result_displays.= '<div class="margin_top_20px"></div>'.$parse_user_result_display;
					}
				} 
			}
			if (count($parse_user_results)>0){
				if($parse_user_result_displays){
					echo "action_success | ".$parse_user_result_displays;
					exit;
				} else if ($parse_user_result_u == $parse_current_user_u) {
					echo 'action_fail | You searched for yourself, silly...';
					exit;
				} else {
					echo 'action_fail | No user found matching '.$search_term.'.';
					exit;
				}
			} else {
				echo 'action_fail | No user found matching '.$search_term.'.';
				exit;
			} 
		} else {
			echo 'action_fail | No user found matching '.$search_term.'.';
			exit;
		}
	} else if( isset($_POST["action"]) && $_POST["action"] == "toggle_friendship" ){
		$toggle_result = "failed";
		$toggle_friend_user_id = $_POST["user_id"];

		$friend_relation = $parse_current_user->getRelation(ParseConstants::KEY_FRIENDS_RELATION);

		if($friend_relation){
			if(isFriend($parse_current_user_uid, $toggle_friend_user_id) ){
				$friend_relation->remove( getParseUserFromId($toggle_friend_user_id) );
				$parse_current_user->save();
				//return result
				$toggle_result = "removed_friend";
				echo "action_success | ".$toggle_result;
				exit;
			} else {
				$friend_relation->add( getParseUserFromId($toggle_friend_user_id) );
				$parse_current_user->save();
				//return result
				$toggle_result = "added_friend";
				echo "action_success | ".$toggle_result;
				exit;
			}
		} else {
			echo "action_failed | Friend toggle failed";
			exit;
		}
	} else {
		echo "action_fail | Requested task failed...";
		exit;
	}
}
?>
