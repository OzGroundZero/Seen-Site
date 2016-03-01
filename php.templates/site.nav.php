<?php 
		//used for appending popups to top of document without effecting the rest of the document
		echo $dynamicPopupDiv;
		/*start the site main body div that holds all but the dynamic popup div
			end of this div can be found in site.footer.php
		*/
		echo '<div id="siteMainBody">';
?><?php
	if($parse_current_user){
		include_once("php.templates/php.templates.nav/nav.home.php");
	} else {
		include_once("php.templates/php.templates.nav/nav.gen.php");
	}
?>