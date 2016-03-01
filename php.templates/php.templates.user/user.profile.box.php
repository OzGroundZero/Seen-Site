<!-- user-profile -->
<div class="user-profile1 text-center">
	<?php 
		if($parse_user_avatar_url != ""){
			echo '<img id="logProfileAvatar" class="profile_image" style="width:102px; height:102px" src="'.$parse_user_avatar_url.'" title="name" />';
		} else {
			echo '<img id="logProfileAvatar" class="profile_image" style="width:102px; height:102px" src="images/avatar.empty.png" title="name" />';
		}
	?>
	<h3><?php echo $parse_current_user_u;?></h3>
	<?php
		if( $parse_current_user_u == 'lwdthe1' || $parse_current_user_u == 'ldaniel' ){
			echo '<p>Computer science major, SUNY Oswego &#39;17</p>';
		} else {
			echo '<p>The best TruFriend a TruFriend could ever have.</p>';
		}
	?>
	<a class="p-btn text_smaller" href="settings">Edit Profile</a>
</div>
<!-- //user-profile -->
<div class="clearfix"><br></div>