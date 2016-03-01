
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
				<li><a href="home">Home</a></li>
				<li class="active"><a href="login">Log In</a></li>
				<li class=""><a href="signup">Sign Up</a></li>
				<li><a href="about">About</a></li>
				<li><a href="terms">Terms of Use</a></li>
			</ul>
		</nav>
	</div>
	<div class="logo">
		<?php echo $site_nav_logo_name;?>
	</div>
	<div class="clearfix"> </div>
