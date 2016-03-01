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
	if($parse_current_user){
		$parse_current_user_id = $parse_current_user->getObjectId();
	}
	$parse_images_query = new ParseQuery(ParseConstants::CLASS_IMAGE_UPLOAD);
	$parse_images_query->limit(5);
	$parse_images_query->descending(ParseConstants::KEY_CREATED_AT);
	$parse_images = $parse_images_query->find();

	$parse_images_count = count($parse_images);
	for ($i = 0; $i < $parse_images_count; $i++) {
		$image = $parse_images[$i];

		$image_id = $image->getObjectId();
		
		$image_date = $image->getCreatedAt();
		$image_date = date_format($image_date, 'g:ia \o\n l jS F Y');
		$image_file = $image->get(ParseConstants::KEY_IMAGE_FILE);
		if( $image_file!= null ){ $image_file_url = $image_file->getURL(); }

		if($image_file_url){
			/*$image_current_user_liked_query = new ParseQuery(ParseConstants::CLASS_LIKES);
			$image_current_user_liked_query->equalTo(ParseConstants::KEY_PHOTO_ID, $image_id);
			$image_current_user_liked_query->equalTo(ParseConstants::KEY_USER_ID, $parse_current_user_id);
			$image_current_user_liked_count = $image_current_user_liked_query->count();

			$parse_image_comments = getPhotoCommentsById($image_id);

			$image_comments = '<div id="seen_image_comments'.$image_id.'" style="display:none">';
			$image_comments_count = count($parse_image_comments);
			//move the comment loading to another function to be loaded when user needs to see it
			//this we we don't load comments until they are needed
			for ($jth_comment = 0; $jth_comment < $image_comments_count; $jth_comment++) {
				$comment = $parse_image_comments[$jth_comment];

				$comment_text = $comment->get(ParseConstants::KEY_COMMENT);
				$image_comment = '<div class="margin_5px background_color_white text_color_grey808080">
				
				<p class="padding_5px text_color_grey808080 text_size_16px">
					<b class="text_smaller" style="color:#16a085">
						'.getParseUserFromId($comment->get(ParseConstants::KEY_USER_ID))->get(ParseConstants::KEY_USERNAME).'
					</b>
					'.$comment_text.'
				</p>
				</div>';
				$image_comments .= $image_comment;

			}
			$image_comments .= '</div>';*/

			$image_file_url = str_replace("invalid-file-key", "b65583c9-aea1-4233-bf07-e2b019f9d885",$image_file_url);

			$image = '<li id="seen_image'.$image_id.'" class="gallery_list padding_5px"
				onmouseover="popupSeen(\''.$image_file_url.'\', \''.$image_date.'\')">';
				$image .= '<div class="background_color_white">';
				$image .= '<img id="seen_image_img'.$image_id.'" src="'.$image_file_url.'"
					onmousedown="doubleTapItem(\''.$image_id.'\')"
					width="auto" height="150px"/>';
				$image .= '<div id="image_actions_container'.$image_id.'" class="100_wide">';
					$image .= '<button id="likebtn'.$image_id.'"
						style="background:transparent; border:none"
						onclick="likePhoto(\''.$image_id.'\')">';
						if(userAlreadyLikedPhoto($parse_current_user_id, $image_id)){
							$image .= '<img id="likebtn_img'.$image_id.'" 
								src="images/design.android.material/ic_favorite_red_24px.svg">';
						} else {
							$image .= '<img id="likebtn_img'.$image_id.'" 
								src="images/design.android.material/ic_favorite_grey_24px.svg">';
						}
						$image .= '<seen id="photo_likes'.$image_id.'" class="text_color_grey808080">';
							//$image .= getPhotoLikesCountById($image_id);
						$image .= '</seen>';
					$image .= '</button>';
					$image .= '<button id="openImgBtn'.$image_id.'"
						style="background:transparent; border:none"
						onclick="openPhoto(\''.$image_file_url.'\', \''.$image_id.'\')">';

						$image .= '<img id="likebtn_img'.$image_id.'" 
							src="images/design.android.material/ic_messenger_grey_24px.svg">';
						
						$image .= '<seen id="photo_likes'.$image_id.'" class="text_color_grey808080">';
							//$image .= getPhotoCommentsCountById($image_id);
						$image .= '</seen>';
					$image .= '</button>';
				$image .= '</div>'.$image_comments.'';
				//$image .= '<span><img src="'.$image_file_url.'" width="500px" height="500px"/></span>';
			$image .= '</div></li>';

			$images.= $image;
		}
	}
?>