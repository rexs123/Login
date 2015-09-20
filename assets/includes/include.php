<?
include('config.php');
$conn = mysqli_connect($server, $user, $pass, $db);
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}

include($_SERVER['DOCUMENT_ROOT'].'/assets/classes/user.php');
$user = new User($conn);

$ver = "3.0.6";

$log_use = $_SESSION['username'];
