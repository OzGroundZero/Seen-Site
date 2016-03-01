<?php 
	include_once("php.loaders/php.loaders.user/user.load.users.related.php");
	$thisIsSearchFriendsPage = true;
?>
<div class="margin_bottom_50px margin_0px background_color_white" style="margin-bottom:50px">
	<div id="searchResults" class="100_wide">
	</div>
</div>
<div class="margin_bottom_50px margin_5px background_color_white" style="margin-bottom:50px">
	<!--<h2 class="text_align_center padding_10px">Related Users</h2>-->
	<?php echo $user_related_users;?>
</div>