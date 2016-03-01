<?php
	use Parse\ParseObject;
	use Parse\ParseUser;

	require 'php.includes/initializeParseClient.php';
	ParseUser::logOut();
	header("location: signup");
	exit();
?>
