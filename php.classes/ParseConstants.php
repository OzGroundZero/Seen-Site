<?php 
	class ParseConstants {
		// Class (database table) name
	    const CLASS_USER = "User";
	    const CLASS_LIKES = "Likes";
	    const CLASS_FRIENDS = "Friends";
	    const CLASS_BLOCKS = "Blocks";
	    const CLASS_COMMENTS = "Comments";
	    const CLASS_IMAGE_UPLOAD = "ImageUpload";
		
		// Field names
		const KEY_ID = "objectId";
		const KEY_IP = "ip";
		const KEY_PASSWORD = "password";

	    const KEY_USER_ID = "userId";
	    const KEY_EMAIL = "email";
	    const KEY_PHOTO_ID = "photoId";
	    //used solely for the Users class (table) in Parse.com queries. unlike the others, it is not camelcase
	    const KEY_USERNAME = "username";
	    const KEY_FRIENDS_RELATION = "friendsRelation";

	    const KEY_RECIPIENT_IDS = "recipientIds";
	    //users who have viewed the message
	    const KEY_VIEWER_IDS = "viewerIds";
	    const KEY_HIDER_IDS = "hiderIds" ;
	    const KEY_SENDER_ID = "senderId";
	    const KEY_SENDER_NAME = "senderName";
	    const KEY_FILE = "file";
	    const KEY_IMAGE_FILE = "imageFile";
	    const KEY_FILE_TYPE = "fileType";
	    const KEY_TEXT_DATA = "textData";
	    const KEY_COMMENT = "comment";

	    const KEY_CREATED_AT = "createdAt";
	    const KEY_UPDATED_AT = "updatedAt";
	    const KEY_IMAGEURL = "imageurl";
	    const KEY_IMAGETITLE = "imagetitle";

	    //miscellaneous values
	    const TYPE_IMAGE = "image";
	    const TYPE_VIDEO = "video";
	    const TYPE_TEXT = "text";
	}
?>