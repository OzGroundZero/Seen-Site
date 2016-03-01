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

$thisIsHomePage = true;
?>
<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
	<title>TruFriend | <?php echo ''.$parse_current_user->get('username').'';?></title>
	<?php include_once("php.classes/User.php");?>
	<?php include_once("php.templates/site.header.php");?>
</head>
<body>
	<?php include("php.templates/site.nav.php");?>
	<!--container-->
	<div class="container">		
		<?php 
			if( isset($_GET["res"]) && isset($_GET["res"]) == "successful_signup" ){
				echo ' 
					<div class="100_wide background_color_nephritis text_color_white padding_20px">
						Welcome to '.$site_name.', '.ucfirst( $parse_current_user->get('username') ).'!
						<div class="clearfix"><br></div>
						<li>Add your TruFriends</li> 
						<li>Send messages</li>
						<li>Take your messages back whenever you feel</li>
					</div>
				';
			}
		?>
		<!--- content -->
		<div class="content">
			<div class="2-cols">
				<div class="col-1 col-md-3">
					<?php include_once("php.templates/php.templates.user/user.profile.box.php");?>
				</div><!--//End-col-1 -->
				<!-- col-3 -->
				<div class="col-md-9">
					<?php
						if( ( isset($_GET["page_fragment"]) && ( $_GET["page_fragment"] == 'sendmessage') ) ) { 
							include_once("php.templates/php.templates.message/message.send.php");
						}
					?>
				</div>
				<!-- col-2 -->
				<div class="clearfix"> </div>
			</div>

		</div>
		
		<!-- //content -->
		<?php include_once("php.templates/site.footer.php");?>
	</div>
	<!---//container-->
</body>
</html>


