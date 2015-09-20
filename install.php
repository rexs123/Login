<?php
require "install_db.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="keywords" content="">
<meta name="author" content="Rexsdev &amp; Design">
<title>Simplex v3 Installer</title>
<link href="/assets/css/bootstrap.css" rel="stylesheet">
<link rel="stylesheet" href="/assets/css/jquery-ui.css">
<link href="/assets/css/style.css" rel="stylesheet">
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
</head>
<body>
<div class="container">
	<div class="col-md-12">
		<div class="col-md-6 col-md-offset-3">
		<br>
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Simplex v3 Installer</h3>
				</div>
					<div class="panel-body">
<?php
$successful = "success";
#Check if cURL Is installed
function _is_curl_installed() {
	if  (in_array  ('curl', get_loaded_extensions())) {
		return true;
	}
	else {
		return false;
	}
}
if (_is_curl_installed()) {
  echo '<div class="alert alert-'.$successful.'" role="alert"><i class="fa fa-check fa-fw"></i>cURL is installed.</div>';
} else {
  echo '<div class="alert alert-danger" role="alert"><i class="fa fa-exclamation-triangle fa-fw"></i>cURL is not installed!</div>';
}
//Check PHP Version
if(phpversion() > 5.0){
echo '<div class="alert alert-'.$successful.'" role="alert"><i class="fa fa-check fa-fw"></i>Your PHP version is up to date!</div>';
}else{
echo '<div class="alert alert-danger" role="alert"><i class="fa fa-exclamation-triangle fa-fw"></i>Your PHP version is ' . phpversion().' which is out dated! Please update to 5.4+</div>';
}
//Check MySQLi is installed
if (function_exists('mysqli_connect')) {
	echo '<div class="alert alert-'.$successful.'" role="alert"><i class="fa fa-check fa-fw"></i>MySQLi is installed/enabled!</div>';
}else{
	echo '<div class="alert alert-danger" role="alert"><i class="fa fa-exclamation-triangle fa-fw"></i>MySQLi is not installed/disabled!</div>';
}
//Check if MySQLi is connected
if ($conn->connect_errno) {
    printf("Connect failed: %s\n", $conn->connect_error);
    exit();
}if ($conn->ping()) {
    echo ('<div class="alert alert-'.$successful.'" role="alert"><i class="fa fa-check fa-fw"></i>MySQLi is connected.</div>');
}else {
    echo ('<div class="alert alert-danger" role="alert"><i class="fa fa-exclamation-triangle fa-fw"></i>MySQLi is not connected!'. $conn->error .'</div>');
}
if($successful = 5){
	echo '<div class="alert alert-info" role="alert"><i class="fa fa-check fa-fw"></i>Perfect, Your site has installed correctly and is now ready to be configured. Remember to delete "Install.php" &amp; "Install_db.php"</div>';
	echo '<div class="well" role="alert">Your default login details are, <br>U: "Admin"<br> P: "Password" <hr>after 3 seconds you will be re-directed to the login page. More information regarding settings and configs can be found on our <a href="http://github.com/rexs123/Simplex/wiki">Wiki</a>.<hr> Remember please change the password by using "<a href="/login/reset.php">Forgot Password</a>", You can set your new email via the admin interface.<hr> Remeber to edit Your "<a href="/admin/settings.php?id=1">Settings</a>"</div>';
	header( "refresh:3;url=login/" );
}else{
	echo '<div class="alert alert-danger" role="alert"><i class="fa fa-exclamation-triangle fa-fw"></i>Something is wrong! If you are hosting from a dedicated server please check how to install the above requirements. If you are hosting this from a shared webhosting service please contact your support staff.</div>';
}
$conn->close();
?>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>