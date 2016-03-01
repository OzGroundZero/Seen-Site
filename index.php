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

if( ( $parse_current_user == null || $parse_current_user =="" ) ){
	header("location: logout");
	exit();
}

$current_user_id = $parse_current_user->getObjectId();
$thisIsHomePage = true;
?><?php
	if( ( isset($_POST["photo_comment"]) && isset($_POST["photo_id"])) ){
		//GET POST or GET VARIABLES depending on origins of the action
		$photo_id = $_POST['photo_id'];
		$photo_comment = $_POST['photo_comment'];
		
		// END FORM DATA ERROR HANDLING
		$comment = new ParseObject(ParseConstants::CLASS_COMMENTS);
		$comment->set(ParseConstants::KEY_COMMENT, $photo_comment);
		$comment->set(ParseConstants::KEY_PHOTO_ID, $photo_id);
		$comment->set(ParseConstants::KEY_USER_ID, $current_user_id);	 
		try {
		  $comment->save();
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
		
		if(!userAlreadyLikedPhoto($current_user_id, $photo_id)){
			$like = new ParseObject(ParseConstants::CLASS_LIKES);
			$like->set(ParseConstants::KEY_PHOTO_ID, $photo_id);
			$like->set(ParseConstants::KEY_USER_ID, $current_user_id);	 
			try {
			  $like->save();
			  // Hooray! Let them use the app now.
			  echo 'liked | '.getPhotoLikesCountById($photo_id);
			  exit();
			} catch (ParseException $ex) {
			  // Show the error message somewhere and let the user try again.
			  echo 'failed |'.$ex->getMessage();
			  exit();
			}
		} else {
			$query = new ParseQuery(ParseConstants::CLASS_LIKES);
			try {
		  		$photo_previous_like_query = new ParseQuery(ParseConstants::CLASS_LIKES);
				$photo_previous_like_query->equalTo(ParseConstants::KEY_PHOTO_ID, $photo_id);
				$photo_previous_like_query->equalTo(ParseConstants::KEY_USER_ID, $current_user_id);
				$photo_previous_like = $photo_previous_like_query->first();
			  	$photo_previous_like->destroy();
			  	echo 'disliked | '.getPhotoLikesCountById($photo_id);
			  	exit();
			} catch (ParseException $ex) {
			  // Show the error message somewhere and let the user try again.
			  echo 'failed |'.$ex->getMessage();
			  exit();
			}			
		}
		exit();
	} else if( (isset($_POST["photo_comment"]) && isset($_POST["photo_id"])) ){
		//GET POST or GET VARIABLES depending on origins of the action
		$photo_id = $_POST['photo_id'];
		$photo_comment = $_POST['photo_comment'];
		
		$comment = new ParseObject(ParseConstants::CLASS_COMMENTS);
		$comment->set(ParseConstants::KEY_PHOTO_ID, $photo_id);
		$comment->set(ParseConstants::KEY_COMMENT, $photo_comment);
		$comment->set(ParseConstants::KEY_USER_ID, $current_user_id);	 
		try {
		  $comment->save();
		  echo 'success';
		  exit();
		} catch (ParseException $ex) {
		  // Show the error message somewhere and let the user try again.
		  echo $ex->getMessage();
		  exit();
		}

	} else if(isset($_POST["photo_pagenate"])){
		if($_POST['last_loaded']!=""){
			$last_loaded = intval($_POST['last_loaded']);
		} else {
			$last_loaded = 0;
		}
		$limit = 5; // default value

		$parse_images_query = new ParseQuery(ParseConstants::CLASS_IMAGE_UPLOAD);
		$parse_images_query->skip($last_loaded);
		$parse_images_query->limit($limit);
		$parse_images_query->descending(ParseConstants::KEY_CREATED_AT);
		$parse_images = $parse_images_query->find();

		$i = 0;
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
								//move this to another method so we only get it when user wants to know
								//$image .= getPhotoLikesCountById($image_id);
							$image .= '</seen>';
						$image .= '</button>';
						$image .= '<button id="openImgBtn'.$image_id.'"
							style="background:transparent; border:none"
							onclick="openPhoto(\''.$image_file_url.'\', \''.$image_id.'\')">';

							$image .= '<img id="likebtn_img'.$image_id.'" 
								src="images/design.android.material/ic_messenger_grey_24px.svg">';
							
							$image .= '<seen id="photo_likes'.$image_id.'" class="text_color_grey808080">';
								//move this to another method so we only get it when user wants to know
								//$image .= getPhotoCommentsCountById($image_id);
							$image .= '</seen>';
						$image .= '</button>';
					$image .= '</div>'.$image_comments.'';
					//$image .= '<span><img src="'.$image_file_url.'" width="500px" height="500px"/></span>';
				$image .= '</div></li>';

				$images.= $image;
			}
		}

		//return results
		if($images!=""){
			$last_loaded = intval($last_loaded)+intval($i);
			echo 'success | '. $images.' @seen '.$last_loaded;
		} else {
			echo 'done | 0';
			exit();
		}
		// sleep for 1 second to see loader, it must be deleted in prodection
		//sleep(1);
		exit();

	}
?>
<!DOCTYPE HTML>
<html>
<head>
	<title>Seen</title>
	<?php include_once("php.classes/User.php");?>
	<?php include_once("php.templates/site.header.php");?>
</head>
<body>
		<?php 
			if( isset($_GET["res"]) && isset($_GET["res"]) == "successful_signup" ){
				echo ' 
					<div class="100_wide background_color_nephritis text_color_white padding_20px">
						<h3>Welcome to '.$site_name.', '.ucfirst( $parse_current_user->get('username') ).'!</h3>
						<p>You may now see the world in a whole new way.</p>
					</div>
				';
			}
		?>
		<?php include_once("php.templates/gallery/gallery.home.php");?>
		<?php include("php.templates/site.nav.php");?>
</body>
</html>