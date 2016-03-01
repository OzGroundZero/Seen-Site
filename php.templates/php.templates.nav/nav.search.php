
	<!--script-for-sidepanle-nav-->
	<link type="text/css" rel="stylesheet" href="css/jquery.mmenu.all.css" />
	<script type="text/javascript" src="js/jquery.mmenu.js"></script>
	<script type="text/javascript">
		//	The menu on the left
		$(function() {
			$('nav#menu-left').mmenu();
		});
	</script>
	<!--//script-for-sidepanle-nav-->
	<div id="page">
		<div id="header">
			<a href="#menu-left"> </a>
		</div>
		<nav id="menu-left" style="display:none">
			<ul>
				<li><a href="friends">Your TruFriends</a></li>
				<li class="search"><a href="search">Find TruFriends</a></li>
				<li><a href="inbox">Inbox</a></li>
				<li><a href="outbox">Outbox</a></li>
				<li><a href="settings">Settings</a></li>
				<li></li><li></li><li></li>				
				<li><a href="terms">Terms & Conditions of Use, Policies</a></li>
			</ul>
		</nav>
	</div>
	<div class="logo">
		<?php echo $site_nav_logo;?>
	</div>
	<!---usernotifications-->
	<div class="usernotifications">
		<ul class="notification list-unstyled user-profile">
			<li><a href="#"><img src="images/notification-icon.png" title="notifications" /></a>
				<ul class="sub list-unstyled">
					<li><a href="#">20</a></li>
				</ul>
			</li>
		</ul>
		<ul class="logout list-unstyled">
			<li><a href="logout"><span> </span></a></li>
		</ul>
	</div>
	<div class="clearfix"> </div>
	<!--//usernotifications-->
