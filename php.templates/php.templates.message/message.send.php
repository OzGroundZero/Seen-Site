<?php
	$send_to_user_usernames = array();
	if ( strpos($_GET["uid"], ',') !== false) {
		$send_to_user_ids = explode(",", $_GET["uid"]);
		foreach($send_to_user_ids as $send_to_user_id){ 
			$parse_user = getParseUserFromId($send_to_user_id);
			if($parse_user){
				$parse_user_uid = $parse_user->getObjectId();
				$parse_user_u = $parse_user->get(ParseConstants::KEY_USERNAME);
				array_push($send_to_user_ids, $parse_user_u);
				if( $j < count($message_recipients)-1 ){
					//not the last element in the array
					$send_to_user_usernames_string.= $parse_user_u.', ';
				} else {
					//this is last element in the array
					$send_to_user_usernames_string.= $parse_user_u.'';
				}
				$parse_user_url = getParseUserAvatarUrl($send_to_user_id);

				$recipient_display = createRecipientDisplay($parse_user_uid, $parse_user_u, $parse_user_url);
				$recipients_display .= $recipient_display;
			}
		}
	} else {
		$send_to_user_ids = array();
		$parse_user = getParseUserFromId($_GET["uid"]);
		$parse_user_uid = $parse_user->getObjectId();
		$parse_user_u = $parse_user->get(ParseConstants::KEY_USERNAME);		
		array_push($send_to_user_ids, $parse_user_u);
		$send_to_user_usernames_string.= $parse_user_u.', ';
		$parse_user_url = getParseUserAvatarUrl($send_to_user_id);

		$recipient_display = createRecipientDisplay($parse_user_uid, $parse_user_u, $parse_user_url);
		$recipients_display = $recipient_display;
	}
?>
<script type="text/javascript">
	var intendedRecipientsIdString = '<?php echo $_GET["uid"];?>';
	var intendedRecipientsUString = '<?php echo $send_to_user_usernames_string;?>';
	var intendedRecipientIds = intendedRecipientsIdString.split(",");
</script>


<div class="padding_10px background_color_white margin_bottom_10px" style="max-width:100%">
	<h2 class="text_align_center padding_10px">Send Message</h2>

	<div class="chat-box">
		<div class="people-on-chat">
			<?php echo $recipients_display;?>
		</div>
		<div class="msg-type-box">
			<form onsubmit="return false">
				<img onclick="document.getElementById('sendMessageFile').click()" src="images/vectors/shutter_grey.svg"/>
				<input id="sendMessageFileSelectedFile" type="text" placeholder="Select a file..." onclick="document.getElementById('sendMessageFile').click()" readonly/>
				<input id="sendMessageFile" style="display:none" type="file"/>
				<input id="sendMessageText" type="text" placeholder="Type your message..."/>
				<input id="sendMessageButton" type="submit" value="Send"/>
			</form>
		</div>
		<!--//msg-type-box-->
	</div>
	<div class="clearfix"> </div>
</div>
