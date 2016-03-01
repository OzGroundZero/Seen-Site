<?php
	if($parse_current_user){
		include_once("php.templates/php.templates.footer/footer.home.php");
		echo '
			<a href="friends">
				<img id="footerGlobalActionButton" class="global_action_button" style="position:fixed; bottom:20px; right:20px;" src="images/design.android.material/ic_add_circle_24px.svg" onclick="document.getElem"/>
			</a>
		';
	} else {
		include_once("php.templates/php.templates.footer/footer.gen.php");
	}

	/*end the site main body div that holds all but the dynamic popup div
		start of this div can be found in site.nav.php
	*/
	echo '<!--END SITE MAIN BODY--></div>';

	/*START BELOW FOLD IMPORTS AND INCLUDES*/
	include_once("php.includes/php.js.scripts/php.js.scripts.parse.sendMessage.php");
	include_once("php.includes/php.js.scripts/php.js.scripts.parse.sendPushNotification.php");
	
	include_once("php.includes/php.js.scripts/php.js.scripts.ajax.php");
	include_once("php.includes/php.js.scripts/php.js.scripts.auth.php");
	include_once("php.includes/php.js.scripts/php.js.scripts.photos.php");
	include_once("php.includes/php.js.scripts/php.js.scripts.google.analyticstracking.php");
	//classes
	include_once("js.classes/Friend.php");

?>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/main.js"></script>
<!--START BELOW FOLD IMPORTS AND INCLUDES-->
<!-- initialize Parse js api-->
<script src="//www.parsecdn.com/js/parse-1.3.4.min.js"></script>
<script type="text/javascript">
	//--- SET THE GLOBAL API keys 
	var parse_app_id = "UxkZAm1ZGbbMETbbGiUiJEpOnxpzN9agWwZHBlh1" 
	var parse_javascript_id = "17lkPwfRbXJ31rxCvpvzeQw8RbFbgKF2urtsjh6F";
	var parse_rest_api_id = "3hWzrJkFgmvkj3SvL2679ektS4dMob0azV0cmoIa" 
	Parse.initialize(parse_app_id, parse_javascript_id);
</script>
<!--END initializing parse js api-->
<script src="http://seen.lincolnwdaniel.com/js.classes/Alert.js"></script>
<script src="http://seen.lincolnwdaniel.com/js.classes/Message.js"></script>

<?php ?>