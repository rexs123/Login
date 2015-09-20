<?php
ob_start();
session_start();
// Information
define('DIR','HTTP://YOURDOMAIN.CA'); //Set your domain
define('SITEEMAIL','mysite@yourdomain.ca');  //Set your administation email 

//Google ReCaptcha 2.0
$siteKey = 'GOOGLEKEY';
$secret = 'GOOGLEKEY'; //Visit http://google.com/recaptcha

//Default time zone
date_default_timezone_set('Toronto/America'); // Set your default time zone. http://php.net/manual/en/timezones.php

//MySQL Information 
$server = 'HOSTNAME'; //State your MySQL server Host (Usually localhost)
$user = 'USERNAME';  // State your MySQL server username
$pass = 'USERS PASSWORD'; // State your MySQL user password
$db = 'DATABASE'; // State your MySQL database name
