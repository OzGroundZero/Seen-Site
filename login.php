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
include_once("php.classes/User.php");

if( ( $parse_current_user != null ) ){
	if( isset($_GET["sus_u"]) && isset($_GET["sus_p"]) ){
			//this evalutes to true if the user is sent to the login page after successful sign up
			require 'php.includes/initializeParseClient.php';
			header("location: home?res=successful_signup");
			exit();
		} else {
			header("location: home");
		}
	exit();
}
$thisIsLoginPage = true;
?><?php
if( ( isset($_POST["u"]) ) || ( isset($_GET["sus_u"]) && isset($_GET["sus_p"]) ) ){
  //GET POST or GET VARIABLES depending on origins of the action
	if( isset($_GET["sus_u"]) && isset($_GET["sus_p"]) ){
  	//this is evaluates when the user successfully signs up and is redirected here by the signup function
		$u = $_GET['sus_u'];
		$p = $_GET['sus_p'];
	} else{
		$u = $_POST['u'];
		$p = $_POST['p'];
	}
    // GET USER IP ADDRESS
	$ip = preg_replace('#[^0-9.]#', '', getenv('REMOTE_ADDR'));

    // FORM DATA ERROR HANDLING
	if($u == "" || $p == ""){
		echo "incomplete_form";
		exit();
	} else {
		if( isset($_GET["sus_u"]) && isset($_GET["sus_p"]) ){
			//this evalutes to true if the user is sent to the login page after successful sign up
			require 'php.includes/initializeParseClient.php';
			header("location: home?res=successful_signup");
			exit();
		} else {
	    	// END FORM DATA ERROR HANDLING
			try {
				require 'php.includes/initializeParseClient.php';
				$user = ParseUser::logIn($u, $p);
				// Do stuff after successful login.
				echo 'login_success | '.$user->get('username');
			} catch (ParseException $ex) {
			    // The login failed. Check error to see why.
				echo 'login_failed | '.$ex->getMessage();
			}
			exit();
		}
	}
	
}
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
	<title>Seen</title>
	<?php include_once("php.templates/site.header.php");?>
</head>
<body>
	<?php include_once("php.templates/site.nav.php");?>
	<!--container-->
	<div class="container">
		<!--- content -->
		<div class="content">
			<div class="3-cols">
				<div class="col-1 col-md-3">
					<!-- user-profile -->
					<div class="padding_5px user-profile1 text-center">
						<img style="max-width:100px" src="images/site/logo.large.png" title="name" />
						<p><?php echo $site_slogan;?></p>
					</div>
					<!-- //user-profile -->									
				</div><!--//End-col-1 -->
				<!-- col-3 -->
				<div class="col-md-6 col-3">

					<!-- sign-in-box -->
					<div class="margin_bottom_50px margin_0px sign-in-box" style="margin-bottom:50px">
						<h2>Log in to your account</h2>
						<h5 id="lstatus"></h5>
						<form id="loginForm" onsubmit="return false;">
							<div class="text-boxs">
								<span class="text-box">
									<label class="s-user"> </label>
									<input type="text" name="lusername" id="lusername" placeholder="Username" required /> 
									<div class="clearfix"> </div>
								</span>
								<span class="text-box">
									<label class="s-lock"> </label>
									<input type="password" name="lpassword" id="lpassword" placeholder="password" required /> 
									<div class="clearfix"> </div>
								</span>
							</div>
							<input id="loginBtn" type="submit" onclick="login()" value="LOG IN" />
						</form>
						<p class="not-member">
							<a class="member-sign" href="#"> Not a member?</a> <a class="member-signup" href="signup">Sign Up Now<span> </span></a>
						</p>
					</div>
					<!--//sign-in-box -->
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

