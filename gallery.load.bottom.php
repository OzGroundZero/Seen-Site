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
	
?><?php 
if(isset($_POST["photo_pagenate"])){
	$last_loaded = $_POST['last_loaded'];
	$limit = 8; // default value

	$parse_images_query = new ParseQuery(ParseConstants::CLASS_IMAGE_UPLOAD);
	$parse_images_query->limit($limit);
	$parse_images_query->descending(ParseConstants::KEY_CREATED_AT);
	$parse_images = $parse_images_query->find();
	for ($i = 0; $i < count($parse_images); $i++) {
		if($i > $last_loaded){
			$image = $parse_images[$i];

			$image_id = $image->getObjectId();
			
			$image_date = $image->getCreatedAt();
			$image_date = date_format($image_date, 'g:ia \o\n l jS F Y');
			$image_file = $image->get(ParseConstants::KEY_IMAGE_FILE);
			if( $image_file!= null ){ $image_file_url = $image_file->getURL(); }

			if($image_file_url){
				$image_current_user_liked_query = new ParseQuery(ParseConstants::CLASS_LIKES);
				$image_current_user_liked_query->equalTo(ParseConstants::KEY_PHOTO_ID, $image_id);
				$image_current_user_liked_query->equalTo(ParseConstants::KEY_USER_ID, $parse_current_user_id);
				$image_current_user_liked_count = $image_current_user_liked_query->count();

				$parse_image_comments = getPhotoCommentsById($image_id);

				$image_comments = '<div id="seen_image_comments'.$image_id.'" style="display:none">';
				for ($jth_comment = 0; $jth_comment < count($parse_image_comments); $jth_comment++) {
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
				$image_comments .= '</div>';

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
								$image .= getPhotoLikesCountById($image_id);
							$image .= '</seen>';
						$image .= '</button>';
						$image .= '<button id="openImgBtn'.$image_id.'"
							style="background:transparent; border:none"
							onclick="openPhoto(\''.$image_file_url.'\', \''.$image_id.'\')">';

							$image .= '<img id="likebtn_img'.$image_id.'" 
								src="images/design.android.material/ic_messenger_grey_24px.svg">';
							
							$image .= '<seen id="photo_likes'.$image_id.'" class="text_color_grey808080">';
								$image .= getPhotoCommentsCountById($image_id);
							$image .= '</seen>';
						$image .= '</button>';
					$image .= '</div>'.$image_comments.'';
					//$image .= '<span><img src="'.$image_file_url.'" width="500px" height="500px"/></span>';
				$image .= '</div></li>';

				$images.= $image;
			}
			echo $images;
		} else {
			echo 'fail';
		}
		
	}

	//if no items are loaded, this value will remain at 0 so no items will be loaded afterward since no item has an id less than 0
	$last_loaded = $last_loaded+5;

	if ($last_loaded_item_id != 0) {
	  echo '<script type="text/javascript">var lastLoadedPhoto = '.$last_loaded';</script>';
	}
	// sleep for 1 second to see loader, it must be deleted in prodection
	//sleep(1);
	exit();
}
?>