<?php include_once("php.includes/php.js.scripts/php.js.scripts.parse.avatarUpload.php");?>
<div class="padding_10px background_color_white margin_bottom_10px" style="max-width:100%">
	<h2 class="text_align_center padding_10px">Profile Pic</h2>

	<form id="fileupload" name="fileupload" enctype="multipart/form-data" method="post"> 
		<fieldset>
			<img onclick="document.getElementById('selectAvatarFile').click()" src="images/vectors/shutter_grey.svg"/>
				<input id="selectAvatarFileSelectedFile" type="text" placeholder="Select a file..."  style="border:none" onclick="document.getElementById('selectAvatarFile').click()" readonly/>
				<input id="selectAvatarFile" style="display:none" type="file"/>
			<input id="uploadbutton" class="p-btn text_smaller margin_5px" style="border: none;" type="button" value="Upload New Avatar"/>
		</fieldset> 
	</form>
	<img id="newAvatar" style="max-width:300px; max-height:100%" src=""/>
</div>
