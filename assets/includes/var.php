<?php
$isadmin = "";
$id = "";
$s_user .= $_SESSION['username'];

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

