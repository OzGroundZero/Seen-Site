<?php
	require 'php.apis/parse.com/parse-php-sdk-master/autoload.php';
	use Parse\ParseClient;
	use Parse\ParseSessionStorage;
	session_start();
	ParseClient::initialize('kNoTYsCvLb5OIPnwxLjHRlQigEncDA6Yy2D7dcYi', 's1a7swlDA6mFjj6ttaNlzhFilDVLlbx9ASsZnHGf', 'XMy8vJmRg1vEoSGfCdzc5SipvfPWZH8RR23kSiGp');	
	ParseClient::setServerURL('https://alkemy.herokuapp.com/parse');
	// set session storage
	ParseClient::setStorage( new ParseSessionStorage() );
?>