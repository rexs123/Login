<?php
$isadmin = "";
$system = "";
$teamspeak = "";
$events = "";
$donate = "";
$serverip = "";
$port = "";
$usr = "";
$id = "";
$isadmin = "";
$s_user .= $_SESSION['username'];
$sql = "SELECT * FROM settings";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
	while($row = $result->fetch_assoc()) {
		$teamspeak = $row['teamspeak'];
		$system = $row['system'];
		$events = $row['events'];
		$donate = $row['donate'];
		$gallery = $row['gallery'];
		$serverip = $row['serverip'];
		$port = $row['port'];
		}
	}
$sql = "SELECT * FROM users WHERE username = '$s_user'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
	while($row = $result->fetch_assoc()) {
		$id = $row['id'];
		$name = $row['username'];
		$isadmin = $row['admin'];
		}
	}
?>

