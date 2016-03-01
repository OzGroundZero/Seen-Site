<?php 
	include("php.loaders/php.loaders.user/user.load.outbox.php");
	$thisIsOutBoxPage = true;
?>
<div class="margin_bottom_50px margin_0px background_color_white" style="margin-bottom:50px">
	<h2 class="text_align_center padding_10px">Outbox</h2>
	<?php echo $outbox_messages;?>
</div>