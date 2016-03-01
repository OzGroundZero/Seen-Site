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
	header("location: home");
	exit();
}
$thisIsSignupPage = true;
?><?php
if( ( isset($_POST["u"]) ) ){
	//GET POST or GET VARIABLES depending on origins of the action
	$u = $_POST['u'];
	$u = preg_replace('#[^a-z0-9_]#', '', $u);
	$u = strtolower($u);
	$p = $_POST['p'];
	$p = str_replace(' ', '', $p);

    // GET USER IP ADDRESS
	$ip = preg_replace('#[^0-9.]#', '', getenv('REMOTE_ADDR'));

    // FORM DATA ERROR HANDLING
	if($u == "" || $p == ""){
		echo "incomplete_form";
		exit();
	} else {
		if (strlen($u)>16 || strlen($u)<4){
			echo 'Usernames must be between 4 and 16 characters long';
		    exit();
		} else if (strlen($p)<8){
			echo 'Password must be at least 8 characters long';
		    exit();
		} else {
	    	// END FORM DATA ERROR HANDLING
	    	$user = new ParseUser();
			$user->set(ParseConstants::KEY_USERNAME, $u);
			$user->set(ParseConstants::KEY_PASSWORD, $p);
			 
			// other fields can be set just like with ParseObject
			$user->set(ParseConstants::KEY_IP, $ip);
			 
			try {
			  $user->signUp();
			  // Hooray! Let them use the app now.
			  echo "success";
			} catch (ParseException $ex) {
			  // Show the error message somewhere and let the user try again.
			  echo $ex->getMessage();
			  exit();
			}
			exit();
		}
	}
	
}
?>
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
				<div id="error"></div>
				<div class="col-md-6 col-3">

					<!-- sign-in-box -->
					<div class="margin_bottom_50px margin_0px sign-in-box" style="margin-bottom:50px">
						<h2>Join Seen</h2>
						<h5 id="sstatus"></h5>
						<form id="signupForm" onsubmit="return false;">
							<div class="text-boxs">
								<span class="text-box">
									<label class="s-user"> </label>
									<input type="text" name="semail" id="susername" placeholder="Username" required /> 
									<div class="clearfix"> </div>
								</span>
								<span class="text-box">
									<label class="s-lock"> </label>
									<input type="password" name="spassword" id="spassword" placeholder="password" required /> 
									<div class="clearfix"> </div>
								</span>
							</div>
							<input id="signupBtn" type="submit" onclick="signup()" value="SIGN UP" />
						</form>
						<p class="not-member">
							<a class="member-sign" href="login"> Already have an account?</a> <a class="member-signup" href="login">Login Now<span> </span></a>
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

