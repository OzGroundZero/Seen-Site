<?php 
	include("php.loaders/php.loaders.user/user.load.inbox.php");
	$thisIsInBoxPage = true;
?>
<div class="margin_bottom_50px margin_0px background_color_white" style="margin-bottom:50px">
	<h2 class="text_align_center padding_10px">Inbox</h2>
	<?php echo $inbox_messages;?>
</div>